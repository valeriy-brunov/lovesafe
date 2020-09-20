/**
 * БЛОК "uploadfiles".
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
          //this.value_text = this.findChildElem( 'value-text' );
          //this.value = this.findChildElem( 'value' );

          // События.
          // Нажатие кнопки выбора файла.
          this._domEvents( this.button_change_files ).on( 'click', function( event ) {
            this.input_form.domElem.click();
            return false;
          });

          // Файлы для загрузки выбраны.
          this._domEvents( this.input_form ).on( 'change', function( event ) {
            var mythis = this;
            //this.toggleMod( 'display', 'formupload', 'indicator' );
            
            
            //var token_fields = this.form.domElem.find( 'input[name="_Token[fields]"]' ).val();
            //var token_unlocked = this.form.domElem.find( 'input[name="_Token[unlocked]"]' ).val();
             //var data = {
               //_Token: [{
                 //'fields': token_fields,
                 //'unlocked': token_unlocked,
              // }]
            //};
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
                //xhr.setRequestHeader( 'X-CSRF-Token', token_fields );
              },
              xhr: function() {
                var xhr = $.ajaxSettings.xhr();
                xhr.upload.addEventListener( 'progress', function( evt ) {
                  if ( evt.lengthComputable ) {
                    // Необходимо загрузить следующий объём данных.
                    //this.progtotal = evt.total;
                    let percentComplete = Math.ceil( evt.loaded / evt.total * 100 );
                    // Двигаем прогресс загрузки.
                    //this.prog = percentComplete;
                //    mythis.value_text.domElem.text( percentComplete + "%" );
                //    mythis.value.domElem.css( 'width', percentComplete + "%" );
                  }
                }, false);
                return xhr;
              },
              success: function( html ) {
                //mythis.toggleMod( 'display', 'formupload', 'indicator' );
                // Принимаем в заголовке токен и изменяем значение скрытого поля "_csrfToken".
                //var token = request.getResponseHeader('X-CSRF-Token');
                //var request = new XMLHttpRequest();
                //var csrfToken = request.getResponseHeader('X-CSRF-Token');
                //$( 'input[name="_csrfToken"]' ).val( token );
                //bemDom.before( object.domElem );
                //console.log(html);
                channels( 'newphoto' ).emit( 'insert', html );
              },
              error: function( data ) {
                console.log(data);
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

