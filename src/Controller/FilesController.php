<?php
declare(strict_types=1);

namespace Lovesafe\Controller;

use Lovesafe\Controller\AppController;
use Laminas\Diactoros\Stream;

use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Lovesafe\Plugin as LovesafePlugin;

use Cake\Http\Exception\NotFoundException;

/**
 * Files Controller
 *
 * @property \Lovesafe\Model\Table\FilesTable $Files
 * @method \Lovesafe\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FilesController extends AppController
{
	/** 
     * Initialize.
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent( 'Lovesafe.Uploadfiles' );
        $this->loadComponent( 'FormProtection' );
        $this->loadComponent( 'Paginator' );
        $this->loadComponent( 'Lovesafe.Streamphoto' );
    }

    /**
     * Пагинатор.
     */
    public $paginate = ['limit' => 8];

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // Если запрашивают страницу через AJAX меняем основной шаблон.
        if ( $this->request->is('ajax') and $this->request->is('post') ) {

            $this->Uploadfiles->upload();
            $this->set( 'obj_images', $this->Uploadfiles->urlsImages() );
// $session = $this->getRequest()->getSession();
// $session->write('d.d', $a);
            // // Кодировка ответа.
            // $this->response = $this->response->withCharset('UTF-8');
            // // Отключить кеширование.
            // $this->response = $this->response->withDisabledCache();
            // // Заголовок.
            // $this->response = $this->response->withType('application/json');
            // // cors
            //$this->response = $this->response->cors( $this->request )
                 //->allowHeaders(['X-CSRF-Token'])
                 //->build();
            // // Создаём новый поток. (use Cake\Http\CallbackStream)
            // $stream = new CallbackStream( function() {
            //     echo json_encode(['out' => ['id' => 'ssssss']]);
            // });
            // $this->response = $this->response->withBody($stream);
            // return $this->response;

            // Основной шаблон.
            $this->viewBuilder()->setLayout( 'ajax' );
            // Вид.
            $this->render('ajax_imgs_start');
        }
        elseif ( $this->request->is('ajax') and $this->request->is('get') ) {
            // Выводим все фотографии владельца фотографий.
            $query = $this->Files
                ->find()
                ->where([
                    'password_id' => 2,
                    'status' => 1,
                ])
                ->order(['created' => 'DESC']);

            $array = $this->paginate($query)->toArray();

            if ( count($array) ) {
                $this->set( 'obj_images', $array );
            }

            // Основной шаблон.
            $this->viewBuilder()->setLayout( 'ajax' );
            // Вид.
            $this->render('ajax_imgs_end');
        }
        else {
            // $session = $this->getRequest()->getSession();
            // dump($session->read('d.d'));
            // Выводим все фотографии владельца фотографий.
            $query = $this->Files
                ->find()
                ->where([
                    'password_id' => 2,
                    'status' => 1,
                ])
                ->order(['created' => 'DESC']);

            $this->set( 'count_images', $query->count() );

            $array = $this->paginate($query)->toArray();

            if ( count($array) ) {
                $this->set( 'obj_images', $array );
            }
        }
    }

    /**
     * Возвращает картинку в виде потока. Путь, переданный данному действию,
     * представляет следующую запись: ../img/big-o2-66-hdd6bh.jpeg
     */
    public function img( $path = null )
    {
        if ( !$path ) return;

        // Загружаем файл конфигурации 'files_default'.
        // use Lovesafe\Plugin as LovesafePlugin;
        $plugin = new LovesafePlugin();
        Configure::config( 'default', new PhpConfig( $plugin->getPath() . 'config/' ) );
        Configure::load( 'upload_files_default' );
        $scrUrl = Configure::read( 'load.scrUrl' );

        $url = explode( '-', $path);
        $url_end = $url[0] . DS . $url[1] . DS . $url[2] . DS . $url[3];

        $stream = new Stream( $scrUrl . $url_end, 'rb' );
        // Отключить кеширование.
        $this->response = $this->response->withDisabledCache();
        // Заголовок.
        $this->response = $this->response->withHeader('Content-type', 'image/jpeg');
        $this->response = $this->response->withBody( $stream );

        return $this->response;
    }

    /**
     * Возвращает текущую фотографию (по которой произощел щелчок) в виде потока.
     */
    public function currentphoto( $fid = null )
    {
        if ( $fid ) {

            $total_page = $this->Files
                ->find()
                ->where([
                    'password_id' => 2,
                    'status' => 1,
                ])
                ->count();

            $current_page = $this->Files
                ->find()
                ->where([
                    'id <=' => $fid,
                    'password_id' => 2,
                    'status' => 1,
                ])
                ->order([ 'id' => 'ASC' ])
                ->count();

            $session = $this->request->getSession();
            $session->write( 'bigphoto.total_page', $total_page );
            $session->write( 'bigphoto.current_page', $current_page );

            $files = $this->Files->get($fid, [
                'contain' => ['Comments'],
                'where' => [
                    'Files.password_id' => 2,
                    'Files.status' => 1,
                ],
            ]);

            $session->write( 'bigphoto.comments', $files->comments );

            return $this->Streamphoto->send( $files->big_url );
        }
        else {
            throw new NotFoundException( __('Такой фотографии нет на сервере!') );
        }
    }

    /**
     * Возвращает следующую фотографию в виде потока.
     */
    public function nextphoto()
    {
        $session = $this->request->getSession();

        if ( $session->check( 'bigphoto.total_page' ) and $session->check( 'bigphoto.current_page' ) ) {

            $total_page = $session->read( 'bigphoto.total_page' );
            $current_page = $session->read( 'bigphoto.current_page' );

            $current_page--;
            if ( $current_page === 0 ) {
                $current_page = $total_page;
            }

            $query = $this->Files
                ->find()
                ->where([
                    'password_id' => 2,
                    'status' => 1,
                ])
                ->order([ 'id' => 'ASC' ])
                ->limit(1)
                ->page( $current_page );

            $session->write( 'bigphoto.current_page', $current_page );

            return $this->Streamphoto->send( $query->first()->big_url );
        }
        else {
            throw new NotFoundException( __('Такой фотографии нет на сервере!') );
        }
    }

    /**
     * Возвращает предыдущую фотографию в виде потока.
     */
    public function prevphoto()
    {
        $session = $this->request->getSession();

        if ( $session->check( 'bigphoto.total_page' ) and $session->check( 'bigphoto.current_page' ) ) {

            $total_page = $session->read( 'bigphoto.total_page' );
            $current_page = $session->read( 'bigphoto.current_page' );

            $current_page++;
            if ( $current_page > $total_page ) {
                $current_page = 1;
            }

            $query = $this->Files
                ->find()
                ->where([
                    'password_id' => 2,
                    'status' => 1,
                ])
                ->order([ 'id' => 'ASC' ])
                ->limit(1)
                ->page( $current_page );

            $session->write( 'bigphoto.current_page', $current_page );

            return $this->Streamphoto->send( $query->first()->big_url );
        }
        else {
            throw new NotFoundException( __('Такой фотографии нет на сервере!') );
        }
    }

    /**
     * View method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $file = $this->Files->get($id, [
            'contain' => ['Passwords'],
        ]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $file = $this->Files->newEmptyEntity();
        if ($this->request->is('post')) {
            $file = $this->Files->patchEntity($file, $this->request->getData());
            if ($this->Files->save($file)) {
                $this->Flash->success(__('The file has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The file could not be saved. Please, try again.'));
        }
        $passwords = $this->Files->Passwords->find('list', ['limit' => 200]);
        $this->set(compact('file', 'passwords'));
    }

    /**
     * Edit method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $file = $this->Files->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $file = $this->Files->patchEntity($file, $this->request->getData());
            if ($this->Files->save($file)) {
                $this->Flash->success(__('The file has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The file could not be saved. Please, try again.'));
        }
        $passwords = $this->Files->Passwords->find('list', ['limit' => 200]);
        $this->set(compact('file', 'passwords'));
    }

    /**
     * Delete method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $file = $this->Files->get($id);
        if ($this->Files->delete($file)) {
            $this->Flash->success(__('The file has been deleted.'));
        } else {
            $this->Flash->error(__('The file could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
