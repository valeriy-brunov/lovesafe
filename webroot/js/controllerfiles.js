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

