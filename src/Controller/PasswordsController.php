<?php
declare(strict_types=1);

namespace Lovesafe\Controller;

use Lovesafe\Controller\AppController;

/**
 * Passwords Controller
 *
 * @property \Lovesafe\Model\Table\PasswordsTable $Passwords
 * @method \Lovesafe\Model\Entity\Password[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PasswordsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $passwords = $this->paginate($this->Passwords);

        $this->set(compact('passwords'));
    }

    /**
     * View method
     *
     * @param string|null $id Password id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $password = $this->Passwords->get($id, [
            'contain' => ['Comments', 'Files', 'Telephones', 'Users'],
        ]);

        $this->set(compact('password'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $password = $this->Passwords->newEmptyEntity();
        if ($this->request->is('post')) {
            $password = $this->Passwords->patchEntity($password, $this->request->getData());
            if ($this->Passwords->save($password)) {
                $this->Flash->success(__('The password has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The password could not be saved. Please, try again.'));
        }
        $this->set(compact('password'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Password id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $password = $this->Passwords->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $password = $this->Passwords->patchEntity($password, $this->request->getData());
            if ($this->Passwords->save($password)) {
                $this->Flash->success(__('The password has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The password could not be saved. Please, try again.'));
        }
        $this->set(compact('password'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Password id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $password = $this->Passwords->get($id);
        if ($this->Passwords->delete($password)) {
            $this->Flash->success(__('The password has been deleted.'));
        } else {
            $this->Flash->error(__('The password could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
