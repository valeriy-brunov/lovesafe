/**
 * УНИВЕРСАЛЬНЫЙ БЛОК "uploadfiles".
 *
 * Блок предназначен для загрузки файлов на сервер методом AJAX с индикацией.
 *
 * Для вставки html-кода необходимо к блоку или элементу добавить класс (примиксовать класс) "uploadfiles i-bem". Далее указать необходимые
 * параметры блока data-bem = '{ "uploadfiles":{} }'. * 
 * Основные параметры:
 * @param {}
 * 
 *
 */
modules.define('uploadfiles', ['i-bem-dom', 'events__channels', 'jquery'], function(provide, bemDom, channels, $) {

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

          // Объекты, с которыми будем работать.
          this.input_form = this.findChildElem( 'input' );
          this.submit_upload = this.findChildElem( 'submit' );
          this.button_change_files = this.findChildElem( 'button-change-files' );
          this.form = this.findChildElem( 'form' );
          this.value_text = this.findChildElem( 'proc' );
          this.value = this.findChildElem( 'color' );

          // События.
          // Нажатие кнопки выбора файла.
          this._domEvents( this.button_change_files ).on( 'click', function( event ) {
			event.preventDefault();
            this.input_form.domElem.click();
          });

          // Файлы для загрузки выбраны.
          this._domEvents( this.input_form ).on( 'change', function( event ) {
            var mythis = this;
            this.toggleMod( 'display', 'formupload', 'indicator' );
            // Указываем на <form> через функцию javascript.
            let id = this.form.domElem.attr( 'id' );
            var formData = new FormData( document.getElementById( id ) );
            $.ajax({
              url: mythis.form.domElem.attr( 'action' ),
              dataType: 'html',
              type: 'POST',
              data: formData,
              cache: false,
              processData: false,
              contentType: false,
              beforeSend: function( xhr ) {
                channels( 'newphoto' ).emit( 'wait' );
                let percentComplete = 0;
                mythis.value_text.domElem.text( percentComplete + "%" );
                mythis.value.domElem.css( 'width', percentComplete + "%" );
              },
              // Процесс загрузки файлов.
              xhr: function() {
                var xhr = $.ajaxSettings.xhr();
                xhr.upload.addEventListener( 'progress', function( evt ) {
                  if ( evt.lengthComputable ) {
                    // Необходимо загрузить следующий объём данных.
                    //this.progtotal = evt.total;
                    let percentComplete = Math.ceil( evt.loaded / evt.total * 100 );
                    // Двигаем прогресс загрузки.
                    //this.prog = percentComplete;
                    mythis.value_text.domElem.text( percentComplete + "%" );
                    mythis.value.domElem.css( 'width', percentComplete + "%" );
                  }
                }, false);
                return xhr;
              },
              // Данные успешно получены.
              success: function( html ) {
                mythis.toggleMod( 'display', 'formupload', 'indicator' );
                channels( 'newphoto' ).emit( 'insert', html );
              },
              // Ошибка при выполнение запроса.
              error: function( data ) {
                console.log( data );
              },
            });
          });

        }
      }
    }

    /**
     *
     */

  },
  {
    /**
     * СТАТИЧЕСКИЕ МЕТОДЫ.
     */
  }

));

});

