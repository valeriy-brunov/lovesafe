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
          let input_form = this.findChildElem( 'input' );
          

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

