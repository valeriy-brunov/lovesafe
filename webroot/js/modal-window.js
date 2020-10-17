modules.define('modal-window', ['i-bem-dom', 'events__channels', 'jquery'], function(provide, bemDom, channels, $) {

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

					// Определяем основные свойства всплывающего окна.
          			this._propertiesAll();

			        // Получаем объекты, с которыми будем работать.
			        this._body = $( 'body' );
			        this._wrap = this.findChildElem( 'wrap' );
			        this._close = this.findChildElem( 'close' );// Иконка закрытия.

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
					this._domEvents( this._close ).on( 'click', function( event ) {
						this.close();
					});

		            // Именованный канал события на открытия модального окна.
			        channels( 'modal-window' ).on( 'openmodal', { mythis: this }, function( event, data ) {
			            // Открыть модальное окно возможно только в текущем экземпляре.
			            if ( event.data.mythis.params.name == data ) {
			            	event.data.mythis.open( data );
			            }
			        });

			        // Именованный канал события на закрытия модального окна.
			        channels( 'modal-window' ).on( 'closemodal', { mythis: this }, function( event ) {
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
	     * Добавляет модификатор к блоку, в результате чего появляется модальное окно.
	     *
	     * @param {string} data
	     *    Имя модального окна, которое пользователь передал через именной канал.
	     */
	    _open: function( data ) {
		    if ( !this._body.hasClass( 'page_modal-window' ) ) {
		        this._body.addClass( 'page_modal-window' );
		    }
		    // Определяем, есть ли прокрутка при открытие модального окна и задаём ширину модального окна такой,
		    // чтобы прокрутка исчезла.
		    // this._propertiesAll();
		    // alert((this._bodyH - this._winH));
		    // if ( (this._bodyH - this._winH) > 0 ) {
		    // 	this._wrap.domElem.height( this._winH );
		    // }
		    // this._wrap.domElem.height( document.body.innerHeight );
		    // Показываем модальное окно.
		    this.toggleMod( 'display', 'hide', 'show' );
		    // Указываем, что модальное окно успешно открыто.
		    this.__self.modal = true;
		    this.__self.namemodal = data;
	    },

	    /**
	     * Закрывает модальное окно.
	     */
	    close: function() {
	    	this.toggleMod( 'display', 'hide', 'show' );
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
