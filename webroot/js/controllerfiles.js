/**
 * БЛОК "controllerfiles".
 *
 * Блок работает совместно с контроллёром "files".
 *
 * Для вставки html-кода необходимо к блоку или элементу добавить класс (примиксовать класс) "controllerfiles i-bem". Далее указать необходимые
 * параметры блока data-bem = '{ "controllerfiles":{} }'.
 *
 * Основные параметры:
 * @param {}
 * 
 *
 */
modules.define('controllerfiles', ['i-bem-dom', 'events__channels', 'jquery'], function(provide, bemDom, channels, $) {

provide(bemDom.declBlock(this.name,
  {
    /**
     * МЕТОДЫ ЭКЗЕМПЛЯРА.
     */

    /**
     * Задание параметров по умолчанию.
     */
    _getDefaultParams: function() {},

    /**
     * Триггеры до установки модификаторов.
     */
    beforeSetMod: {},

    /**
     * Триггеры после установки модификаторов.
     */
    onSetMod: {
      'js': {
        // Конструктор экземпляра.
        'inited': function() {

          // События.
          // Щелчок по превью фотографии вызовёт открытие модального окна.
          this._clickPhoto();

          // Пагинатор запрашивает следующую страницу.
          channels( 'nextphoto' ).on( 'next', function( event, url_ ) {
            var url = url_;
            $.ajax({
              url: url,
              dataType: 'html',
              type: 'GET',
              cache: false,
              processData: false,
              contentType: false,
              beforeSend: function( xhr ) {
                channels( 'newpagination' ).emit( 'wait' );
              },
              // Данные успешно получены.
              success: function( html ) {
                channels( 'newpagination' ).emit( 'insert', html );
              },
              // Ошибка при выполнение запроса.
              error: function( data ) {
                console.log( data );
              },
            });
          });

          // Произошла вставка новой порции данных.
          channels( 'newpagination' ).on( 'insertend', { mythis : this }, function( event ) {
            // Так как блоки "paste", "paste2" вставляют html-разметку, то и инициализируются только элементы этих блоков.
            // Чтобы инициализировать текущий блок, необходимо проделать следующие операции.
            let pr_photo = event.data.mythis.findChildElems( 'previewphoto-photo' ).domElem;
            bemDom.init( pr_photo );
            event.data.mythis._clickPhoto();
          });

          // Произошла вставка html-разметка новых загруженных фотографий.
          channels( 'newphoto' ).on( 'insertend', { mythis : this }, function( event ) {
            let pr_photo = event.data.mythis.findChildElems( 'previewphoto-photo' ).domElem;
            bemDom.init( pr_photo );
            event.data.mythis._clickPhoto();
          });

        }
      }
    },

    /**
     * Устанавливает событие - щелчок по превью фотографии.
     */
    _clickPhoto: function() {
      // Клик по любой фотографии.
      this._domEvents( this.findChildElems( 'previewphoto-photo' ) ).on( 'click', function( event ) {
        let fid = event.currentTarget.dataset.fid;
        channels( 'preview-big-photo' ).emit( 'view', fid );
        // Открыть модальное окно.
        channels( 'modal-window' ).emit( 'openmodal', 'big_photo' );
      });
    },

  },
  {
    /**
     * СТАТИЧЕСКИЕ МЕТОДЫ.
     */
  }

));

});

