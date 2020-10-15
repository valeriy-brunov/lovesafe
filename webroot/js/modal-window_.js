/**
 * БЛОК "modal-window".
 *
 * Блок предназначен для показа модального (всплывающего) окна.
 *
 * Для вставки html-кода необходимо к блоку или элементу добавить класс (примиксовать класс) "modal-window i-bem". Далее указать необходимые
 * параметры блока data-bem = '{ "modal-window" : {"name" : "имя модального окна для его идентификации"}'. Например:
 * <div class="modal-window i-bem" data-bem='{ "modal-window" : {"name" : "qwe22344"} }'>
 *  <div class="modal-window__wrap">
 *    <div class="modal-window__shell">
 *      <a class="modal-window__close" href="#">Закрыть</a>
 *      ...
 *    </div>
 *  </div>
 * </div>
 *
 * Основные параметры:
 * @param {string} height min|max
 *    Определяет высоту модального окна: "min" - высота модального окна будет охватывать содержимое, "max" - высота модального окна
 *    будет равна высоте окна просмотра браузера.
 * @param {string} width min|max
 *    Определяет ширину модального окна: "min" - ширина модального окна будет охватывать содержимое, "max" - ширина модального окна
 *    будет равна ширине окна просмотра браузера.
 *
 * Пример открытия модального окна.
 *    channels( 'modal-window' ).emit('openmodal', "qwe666");
 * Пример закрытия модального окна:
 *    channels( 'modal-window' ).emit( 'closemodal' );
 * Именной канал, сообщающий об закрытии модального окна.
 *    channels( 'modal-window' ).on( 'close-modal' );
 */
modules.define('modal-window', ['i-bem-dom', 'events__channels', 'jquery'], function(provide, bemDom, channels, $) {

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
	        	height: 'min',
	        	width: 'min',
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

					// Определяем основные свойства всплывающего окна.
          			this._propertiesAll();

			        // Получаем объекты, с которыми будем работать.
			        this._body = $( 'body' );
			        // this._wrap = this.findChildElem( 'shell' );// Модальное окно.
			        //this._modal = this.findChildElem( 'wrap' );
			        this._wrap = this.findChildElem( 'wrap' );
			        this._iconclose = this.findChildElem( 'close' );// Иконка закрытия.

		            // События.
		            // Следующие два события происходят одновременно, если курсор находится в пределах модального окна.
		            // В этом случае событие 2 происходит перед событием 1, иначе происходит только событие 1 (щелчок вне модального окна).
		            var e = 0;
		            // Событие 2: клик в районе модального окна.
		            this._domEvents( this._wrap ).on( 'click',
		            function( event ) {
		              e = 2;
		            });
		            // Событие 1: клик за пределами модального окна.
		            this._domEvents().on( 'click', function( event ) {
		                if ( e == 1 || e == 0 ) {
		            		// Клик за пределами модального окна.
		            		this.close();
			            }
			            else {
			            	// Клик в модальном окне.
			            	e = 1;
			            }
		            });

		            // Щелчок на иконку закрытия модального окна.
					this._domEvents( this._iconclose ).on( 'click', function( event ) {
						this.close();
					});

		            // Cобытие: размеры окна браузера изменены.
		            this._domEvents( bemDom.win ).on( 'resize', {
		            	mythis: this,
		            }, function( event ) {
			            if ( this.__self.modal == true ) {
			            	event.data.mythis._openAgain( event.data.mythis.params.name );
			            }
		          	});

			        // Именованный канал события на открытия модального окна.
			        channels( 'modal-window' ).on( 'openmodal', {
			            mythis: this,
			        }, function( event, data ) {
			            // Открыть модальное окно возможно только в текущем экземпляре.
			            if ( event.data.mythis.params.name == data ) {
			            	event.data.mythis.open( data );
			            }
			        });

		        	// Именованный канал события на закрытия модального окна.
			        channels( 'modal-window' ).on( 'closemodal', {
			            mythis: this,
			        }, function( event ) {
			          	event.data.mythis.close();
			        });

				}
			}
		},

	    /**
	     * Открывает модальное окно.
	     *
	     * @param {string} data
	     *    Имя модального окна, которое пользователь передал через именной канал.
	     */
	    open: function( data ) {
	      	// Получаем свойства окна браузера.
		    this._propertiesAll();
		    // Если модальное окно открывается впервые.
		    if ( !this.__self.modal ) {
		        this._open( data );
		    }
		    // Если модальное окно уже открыто.
		    if ( this.__self.modal ) {
		        // Если необходимо закрыть окно не из текущего экземпляра.
		        if ( this.__self.namemodal != data ) {
		          channels( 'modal-window' ).emit( 'closemodal', this.__self.namemodal );
		        }
		        this.close();
		        this._open( data );
		    }
	    },

	    /**
	     * Добавляет модификатор к блоку, в результате чего появляется модальное окно.
	     *
	     * @param {string} data
	     *    Имя модального окна, которое пользователь передал через именной канал.
	     */
	    _open: function( data ) {
		    if ( !this._body.hasClass( 'page_modal-window' ) ) {
		        this._body.addClass( 'page_modal-window' );
		    }
		    if ( this.params.height == 'max' ) {
		        // Отступы модального окна.
		        let padding_top_bottom = Math.floor(( this._modal.domElem.innerHeight() - this._modal.domElem.height() ) / 2);
		        this._wrap.domElem.height( this._winH - padding_top_bottom );
		    }
		    if ( this.params.width == 'max' ) {
		        // Отступы модального окна.
		        let padding_left_right = Math.floor(( this._modal.domElem.innerWidth() - this._modal.domElem.width() ) / 2);
		        this._wrap.domElem.width( this._winW - padding_left_right );
		    }
		    // Предварительно показываем окно для определения его размера.
		    this.setMod( 'size', 'big' );
		    // В зависимости от размера окна.
		    this.setMod( 'size', this._resize() );
		    // Указываем, что модальное окно успешно открыто.
		    this.__self.modal = true;
		    this.__self.namemodal = data;
	    },

	    /**
	     * Если размеры окна браузера окна изменились.
	     *
	     * @param {string} data
	     *    Имя модального окна, которое пользователь передал через именной канал.
	     */
	    _openAgain: function( data ) {
	      	this._propertiesAll();
	      	if ( this.params.height == 'max' ) {
	        	// Отступы модального окна.
	        	let padding_top_bottom = Math.floor(( this._modal.domElem.innerHeight() - this._modal.domElem.height() ) / 2);
	        	this._wrap.domElem.height( this._winH - padding_top_bottom );
	      	}
	      	if ( this.params.width == 'max' ) {
	        	// Отступы модального окна.
	        	let padding_left_right = Math.floor(( this._modal.domElem.innerWidth() - this._modal.domElem.width() ) / 2);
	        	this._wrap.domElem.width( this._winW - padding_left_right );
	      	}
	    },

		/**
	     * Устанавливает основные свойства всплывающего окна.
	     */
	    _propertiesAll: function() {
		    // Высота окна браузера.
		    this._winH = document.documentElement.clientHeight;
		    // Высота всего документа с учетом прокрутки (для всех браузеров), включая его невидимую часть (если такая область имеется).
		    this._bodyH = Math.max(
		        document.body.scrollHeight,
		        document.documentElement.scrollHeight,
		        document.body.offsetHeight,
		        document.documentElement.offsetHeight,
		        document.body.clientHeight,
		        document.documentElement.clientHeight
	      	);
	        // Высота невидимой верхней части страницы (для всех браузеров).
	        this._scrollTop = window.pageYOffset || document.documentElement.scrollTop;
	        // Ширина окна браузера исключая прокрутку.
	        this._winW = document.documentElement.clientWidth;
	    },

	    /**
	     * Возвращает строку, содержащую "small" или "big", в зависимости от размера модального окна.
	     * Метод следует использовать только после отображения модального окна.
	     *
	     * @return {string} small|big
	     *		small - высота модального окна ниже окна браузера, big - высота модального окна выше окна браузера.
	     */
	    _resize: function() {
	    	this._propertiesAll();
	    	// После отображения модального окна можно определить его высоту.
	      	let modalH = this._wrap.domElem.height();
	      	// Если модальное окно по высоте ниже окна браузера.
	      	if ( modalH < this._winH ) {
	        	return 'small';
	      	}
	      	else {
	        	return 'big';
	      	}
	    },

	    /**
	     * Закрывает модальное окно.
	     */
	    close: function() {
	      	if ( this.hasMod( 'size', 'big' ) ) {
	        	this.delMod( 'size', 'big' );
	      	}
	      	if ( this.hasMod( 'size', 'small' ) ) {
	        	this.delMod( 'size', 'small' );
	      	}
	      	this.__self.modal = false;
	      	this._body.removeClass( 'page_modal-window' );
	      	channels( 'modal-window' ).emit( 'close-modal' );
	    },

	},
	{
		/**
		 * Cтатические методы.
		 */

	    /**
	     * Указывает открыто или закрыто модальное окно.
	     */
	    modal: null,

	    /**
	     * Имя модального окна.
	     */
	    namemodal: null,

	}
));

});
