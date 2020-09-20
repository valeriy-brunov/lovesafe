/**
 * УНИВЕРСАЛЬНЫЙ БЛОК "paste".
 *
 * Блок предназначен для вставки внутрь себя текста или html вёрcтки.
 *
 * Внутри блока могут располагаться дополнительные элементы: "paste__trubber", "paste__other", "paste__delete". Код самостоятельно
 * определит нахождение или отсутствие элементов, указывать дополнительно отсутствие или нахождение дополнительных элементов не требуется.
 *
 * Для вставки html-кода необходимо к блоку или элементу добавить класс (примиксовать класс) "paste i-bem". Далее указать необходимые
 * параметры блока data-bem = '{ "paste":{} }'.
 *
 * Основные параметры:
 * @param {string} channel
 *    Имя канала через который будут передаваться данные для вставки. В качестве имени канала рекомендуется выбирать
 *    имя блока, отправляющего данные - разметку html.
 * @param {object} init
 *    Стартовый режим "init". Содержит порядок отображения дополнительных элементов.
 * @param {object} wait
 *    Режим ожидания "wait". Содержит порядок отображения дополнительных элементов.
 * @param {object} insert
 *    Режим вставки "insert". Содержит порядок отображения дополнительных элементов.
 * @param {object} insert
 *    Режим сброса "reset". Содержит порядок отображения дополнительных элементов.
 *
 * Порядок отображения дополнительных элементов блока "paste" задаётся с помощью режимов (mode). Всего есть 4 режима.
 *  "init" - стартовый режим;
 *  "wait" - режим ожидания;
 *  "insert" - режим вставки;
 *  "reset" - режим сброса.
 *
 * Пример "чистого" шаблона:
 * <div class="paste i-bem" data-bem='{ "paste" : {"channel":"mychannel","init":{"other":true}} }'>
 *  <div class="paste__trubber paste__trubber_hide">...</div>
 *  <div class="paste__other paste__other_hide">...</div>
 *  <div class="paste__delete paste__delete_hide">...</div>
 * </div>
 * Обратите внимание, что у каждого элемента указан модификатор "hide", его необходимо указывать обязательно.
 *
 * Пример событий:
 *    Режим ожидания:
 *      channels( 'text-new-messages' ).emit( 'wait' );
 *    Режим вставки:
 *      channels( 'text-new-messages' ).emit( 'insert', html );
 *    Стартовый режим:
 *      channels( 'text-new-messages' ).emit( 'init' );
 *    Режим сброса:
 *      channels( 'text-new-messages' ).emit( 'reset' );
 *
 * Вышеприведенный команды с режимами рекомендуется указывать в коде содержащий AJAX-запрос.
 * Три вышеуказанных режима занимаются отправкой команды из именного канала и установкой элементов cогласно настройкам параметров.
 * Режим (insert) вставляет данные, заменяя элемент "delete" переданными данными. Поэтому у данного режима есть второй аргумент,
 * содержащий данные для вставки. В добавок к режиму вставки данных (insert), по этому же именному каналу, возвращается команда (insertend),
 * говорящяя об успешной вставки данных. Рекомендуется только после возвращения данной команды производить какие-либо действия
 * над вставленными данными.
 */
modules.define('paste', ['i-bem-dom', 'events__channels', 'jquery'], function(provide, bemDom, channels, $) {

provide(bemDom.declBlock(this.name,
  {
    /**
     * МЕТОДЫ ЭКЗЕМПЛЯРА.
     */

    /**
     * Задание параметров по умолчанию.
     */
    _getDefaultParams: function() {
      return {
        channel: null,
        init: {
          trubber: false,
          other: true,
          delete: false,
        },
        wait: {
          trubber: true,
          other: false,
          delete: false,
        },
        insert: {
          trubber: false,
          other: false,
          delete: true,
        },
        reset: {
          trubber: false,
          other: false,
          delete: false,
        },
      }
    },

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

          // Устанавливаем первоначальный режим.
          this._setupElem( 'init' );

          // События.
          if ( this.params.channel ) {
            // Именной канал на ожидание вставки html-кода.
            channels( this.params.channel ).on( 'wait', {
              mythis: this,
            }, function( event ) {
              event.data.mythis._setupElem( 'wait' );
            });
            // Именной канал на вставку нового html-кода.
            channels( this.params.channel ).on( 'insert', {
              mythis: this,
            }, function( event, html ) {
              event.data.mythis._insert( html );
            });
            // Именной канал на запуск первоначального режима.
            channels( this.params.channel ).on( 'init', {
              mythis: this,
            }, function( event, html ) {
              event.data.mythis._setupElem( 'init' );
            });
            // Именной канал на режим сброса.
            channels( this.params.channel ).on( 'reset', {
              mythis: this,
            }, function( event, html ) {
              event.data.mythis._setupElem( 'reset' );
            });
          }

        }
      }
    },

    /**
     * Устанавливает режимы отображения элементов "trubber", "other", "delete".
     *
     * @param {mode} mode init|wait|insert|reset
     *    Режимы отображения элементов "trubber", "other", "delete" согласно заданным параметрам.
     */
    _setupElem: function( mode ) {
      let object_param = null;
      // Выбираем режим.
      switch( mode ) {
        case 'init':
          object_param = this.params.init;
          break;
        case 'wait':
          object_param = this.params.wait;
          break;
        case 'insert':
          object_param = this.params.insert;
          break;
        case 'reset':
          object_param = this.params.reset;
          break;
      }
      let _trubber = this.findChildElem( 'trubber' );
      if ( object_param.trubber && _trubber ) {
        _trubber.delMod( 'hide' );
      }
      if ( !object_param.trubber && _trubber ) {
        _trubber.setMod( 'hide' );
      }
      let _other = this.findChildElem( 'other' );
      if ( object_param.other && _other ) {
        _other.delMod( 'hide' );
      }
      if ( !object_param.other && _other ) {
        _other.setMod( 'hide' );
      }
      let _delete = this.findChildElems( 'delete' );
      if ( object_param.delete && _delete ) {
        _delete.delMod( 'hide' );
      }
      if ( !object_param.delete && _delete ) {
        _delete.setMod( 'hide' );
      }
    },

    /**
     * Вставка html-разметки с заменой элемента(-ов) "paste__delete" внутри блока.
     *
     * @param {string} html
     *    Строка, содержащая html разметку.
     */
    _insert: function( html ) {
      this._delete = this.findChildElems( 'delete' );
      if ( this._delete.size() > 0 ) {
        var i = 1;
        this._delete.forEach( function( object ) {
          if ( i == 1) {
            bemDom.replace( object.domElem, html );
            i++;
          }
          else {
            bemDom.destruct( object.domElem );
          }
        });
        if ( this.params.channel ) {
          channels( this.params.channel ).emit( 'insertend' );
        }
      }
      this._setupElem( 'insert' );
    },

  },
  {
    /**
     * СТАТИЧЕСКИЕ МЕТОДЫ.
     */
  }

));

});

/**
 * БЛОК "paste2".
 */
modules.define('paste2', ['i-bem-dom', 'paste', 'events__channels', 'jquery'], function(provide, bemDom, paste, channels, $) {

provide(bemDom.declBlock(this.name, paste, {}, {} ));

});

/**
 * БЛОК "paste3".
 */
modules.define('paste3', ['i-bem-dom', 'paste', 'events__channels', 'jquery'], function(provide, bemDom, paste, channels, $) {

provide(bemDom.declBlock(this.name, paste, {}, {} ));

});
