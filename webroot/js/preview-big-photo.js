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
		_getDefaultParams: function() {
			return {
				total_photos: 18,
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

					// Объекты для работы.
					this._img = this.findChildElem( 'img' );
					this._nextphoto = this.findChildElem( 'nextphoto' );
					this._prevphoto = this.findChildElem( 'prevphoto' );

					// События.
					// Пользователь произвёл щелчок по превью фотографии.
					channels( 'preview-big-photo' ).on( 'view', { mythis : this }, function( event, fid ) {
						// Меняем адрес у тега "img".
						event.data.mythis.setMod( 'display', 'loader' );
						event.data.mythis._img.domElem.attr( 'src', window.location.pathname + '/currentphoto/' + fid );
						// Задаём параметры для отслеживания просмотра фотографий.
						event.data.mythis._next = 0;
						event.data.mythis._max_next = 0;
						event.data.mythis._prev = 0;
						event.data.mythis._max_prev = 0;
					});

					// Фотография загружена.
					this._domEvents( this._img ).on( 'load', function( event ) {
						this.setMod( 'display', 'img' );
					});

					// Пользователь произвёл щелчок на объекте "следующее фото".
					if ( this._nextphoto ) {
						this._domEvents( this._nextphoto ).on( 'click', function( event ) {

							event.preventDefault();

							this._next++;
							this._prev--;
							if ( this._max_next < this._next  ) {
								this._max_next = this._next;
							}

							// Проверка на граничные условия.
							this._viewAllPhotos();

							// Загружаем фотографию ввиде потока.
							this.toggleMod( 'display', 'img', 'loader' );
							this._img.domElem.attr( 'src', window.location.pathname + '/nextphoto/?_=' + Math.random() );
						});
					}

					// Пользователь произвёл щелчок на объекте "предыдущее фото".
					if ( this._prevphoto ) {
						this._domEvents( this._prevphoto ).on( 'click', function( event ) {

							event.preventDefault();

							this._next--;
							this._prev++;
							if ( this._max_prev < this._prev  ) {
								this._max_prev = this._prev;
							}

							// Проверка на граничные условия.
							this._viewAllPhotos();

							// Загружаем фотографию ввиде потока.
							this.toggleMod( 'display', 'img', 'loader' );
							this._img.domElem.attr( 'src', window.location.pathname + '/prevphoto/?_=' + Math.random() );
						});
					}
				}
			}
		},

		/**
		 * Проверяет на граничное условие (пользователь просмотрел все фотографии).
		 */
		_viewAllPhotos: function() {
			if ( this._max_next == this.params.total_photos ) {
				alert('Все фотографии просмотрены!');
			}
			if ( this._max_prev == this.params.total_photos ) {
				alert('Все фотографии просмотрены!');
			}
			if ( (this._max_prev + this._max_next) == this.params.total_photos ) {
				alert('Все фотографии просмотрены!');
			}
		},

	},
	{
		/**
		 * СТАТИЧЕСКИЕ МЕТОДЫ.
		 */
	}

));

});
