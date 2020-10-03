/**
 * БЛОК "preview-big-photo".
 */
modules.define('preview-big-photo', ['i-bem-dom', 'events__channels', 'jquery'], function(provide, bemDom, channels, $) {

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

					// Объекты для работы.
					this._img = this.findChildElem( 'img' );
					this._nextphoto = this.findChildElem( 'nextphoto' );
					this._prev = this.findChildElem( 'prevphoto' );

					// События.
					// Пользователь произвёл щелчок по превью фотографии.
					channels( 'preview-big-photo' ).on( 'view', { mythis : this }, function( event, fid ) {
						// Меняем адрес у тега "img".
						event.data.mythis._img.domElem.attr( 'src', window.location.pathname + '/currentphoto/' + fid );
						
					});

					// Пользователь произвёл щелчок на объекте "следующее фото".
					if ( this._nextphoto ) {
						this._domEvents( this._nextphoto ).on( 'click', function( event ) {
							event.preventDefault();
							this._img.domElem.attr( 'src', window.location.pathname + '/nextphoto/?_=' + Math.random() );
						});
					}

					// Пользователь произвёл щелчок на объекте "предыдущее фото".
					if ( this._prev ) {
						this._domEvents( this._prev ).on( 'click', function( event ) {
							event.preventDefault();
							this._img.domElem.attr( 'src', window.location.pathname + '/prevphoto/?_=' + Math.random() );
						});
					}

				}
			}
		},

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
