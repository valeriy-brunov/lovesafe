/**
 * УНИВЕРСАЛЬНЫЙ БЛОК "paginator".
 *
 * Блок предназначен для осуществления листинга частями.
 *
 * Для вставки html-кода необходимо к блоку или элементу добавить класс (примиксовать класс) "paginator i-bem". Далее указать необходимые
 * параметры блока data-bem = '{ "paginator":{} }'.
 *
 * Основные параметры:
 * @param {string} channel
 *    Имя канала блока "paste", к которому будет привязан пагинатор.
 * @param {string} channelnext
 *    Имя канала, через который будет запрашиваться следующая порция данных.
 * @param {string} autopaginator
 *    Включает или отключает автопагинацию:
 * 		"null" - автопагинация отключена (по умолчанию);
 * 		"top" - автопагинация вверх;
 * 		"bottom" - автопагинация вниз.
 *
 * Перечень элементов пагинатора:
 *   "paginator__object" - объект (элемент), на котором будет располагаться событие для просмотра следующей порции листинга;
 *   "paginator__page" - объект (элемент) со скрытым полем, содержащим значение page для пагинации.
 *
 * Пример верстки элементов пагинатора:
 *
 * <div class="paste__other paste__other_hide paginator__object">смотреть ещё...</div>
 * <div class="paste__delete paste__delete_hide paste__delete paginator__page">
 *  <input type="hidden" name="page" value="1">
 * </div>
 * 
 * Пагинатор использует общую вёрстку с блоком "paste", за исключением того, что блок "paginator" добавляет свои элементы
 * "paginator__object", при щелчке по которому будет добавлена следующая порция данных и "paginator__page", элемент со скрытым полем,
 * содержащим значение page для пагинации.
 * Если включена автопагинация ("autopaginator" равен "top" или "bottom"), то объект пагинации необходимо все равно указывать, только
 * без надписи "смотреть ещё...":
 *  <div class="paste__other paste__other_hide paginator__object"></div>
 *
 * Последовательность работы будет следующая:
 * 1. После того, как страница полностью загрузилась, блок "paste" выставляет видимость дополнительных элементов согласно настройкам.
 *    Предположим, что у нас выставлены настройки по умолчанию. Тогда элемент "paste__other" после загрузки будет видим и блок "paginator"
 *    повесит событие "click" на элемент "paginator__object".
 * 2. При щелчке по элементу "paginator__object", блок "paginator" по именному каналу, указанному в настройках блока "paginator" (имя канала
 *    блоков "paginator" и "paste" должны совпадать) запрашивает очередную порцию данных у AJAX-кода. AJAX-код, который будет возвращать
 *    порциями данные, должен располагаться в другом блоке и может при запросе очередных данных изменять режимы отображения дополнительных
 *    элементов блока "paste".
 * 3. Пример взаимодействия блоков "paste", "paginator" и блока "controllerfiles", содержащий AJAX-код для совершения пагинации.
 *
 *	  {
 *      "paste":{ "channel":"listcomments" },
 *      "paginator":{ "channel":"listcomments", "channelnext":"nextcomments" },
 *	    "controllerfiles":{}
 *    }
 *
 *    В приведённом выше примере блок "controllerfiles" должен содержать именной канал слушателя события "next", которое возникает при
 *	  клике по надписи "смотреть ещё...":
 *
 *    channels( 'nextcomments' ).on( 'next', function( event, url_ ) {
 *      var url = url_;
 *		  $.ajax({
 *				url: url,
 *				...
 *				beforeSend: function( xhr ) {
 *          channels( 'listcomments' ).emit( 'wait' );
 *        },
 *        success: function( html ) {
 *          channels( 'listcomments' ).emit( 'insert', html );
 * 				},
 *				...
 *			});
 *		});
 *
 *		Обратите внимание, что событие "next" именного канала "nextcomments" передаёт параметр "_url". Этот параметр содержит
 *		адрес AJAX-запроса, а также "get" параметр "page".
 * 4. После щелчка по "смотреть ещё...", блоку "paste" ,будет установлен режим "wait". Как только данные от сервера возвратяться
 *		AJAX-коду ввиде html-разметки, блоку "paste" будет установлен режим "insert" (вставка). Режим вставки заменит элемент
 *		"paste__delete" на данные пришедшие с сервера. Если внутри присланных данных будет присутствовать скрытое поле с именем
 *		name="page", то js-код пагинатора установит блоку "paste" режим "init" (начальный режим), обычно в этом режиме показывается
 *		"смотреть ещё...". Если же скрытое поле не будетнайдено js-кодом пагинатора, то блоку "paste" установят режим "reset"
 *		(обычно в этом режиме скрыты все вспомогательные элементы).
 * 5. Рекомендации по вёрстке вспомогательных блоков "paste" и "paginator".
 *
 *		Для первой загрузке страницы необходимо использовать шаблон:
 *
 *		<?php $this->Paginator->setTemplates([
 *			'nextActive' => '
 *				<div class="paste__delete paste__delete_hide paste__delete paginator__page">
 *					<input type="hidden" name="page" value="{{url}}">
 *				</div>
 *				<div class="paste__trubber paste__trubber_hide">загрузка...</div>
 *				<div class="paste__other paste__other_hide paginator__object">смотреть ещё...</div>',
 *			'nextDisabled' => '',
 *		]) ?>
 *		<?php echo $this->Paginator->next() ?>
 *
 *		Для страницы запрашиваемой через AJAX:
 *
 *		<?php $this->Paginator->setTemplates([
 *			'nextActive' => '
 *				<div class="paste2__delete paste2__delete_hide paste2__delete paginator__page">
 *					<input type="hidden" name="page" value="{{url}}">
 *				</div>',
 *			'nextDisabled' => '',
 *		]) ?>
 *
 *		<?php echo $this->Paginator->next() ?>
 */
modules.define('paginator', ['i-bem-dom', 'events__channels', 'jquery'], function(provide, bemDom, channels, $) {

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
				channelnext: null,
				autopaginator: null,
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
					this._object = this.findChildElem( 'object' );

					// События.
					// Устанавливаем событие на объект (элемент) пагинации (например, "смотреть ещё").
					if ( this._object && !this.params.autopaginator ) {
						this._domEvents( this._object ).on( 'click', function( event ) {
							event.preventDefault();
							this._nextPaginator();
						});
					}

					// Если включена верхняя автопагинация.
					if ( this._object && this.params.autopaginator == 'top' ) {
					  this._domEvents().on( 'scroll', { mythis : this }, function( event ) {
						if ( event.data.mythis.domElem.scrollTop() == 0 ) {
						  // Скролл достиг верха.
						  event.data.mythis._nextPaginator();
						}
					  });
					}

					// Если включена нижняя автопагинация.
					if ( this._object && this.params.autopaginator == 'bottom' ) {
					  this._domEvents().on( 'scroll', { mythis : this }, function( event ) {
						let height_top = event.data.mythis.domElem.scrollTop();
						let height_win = this.domElem.height();
						if ( (height_win + height_top) >= this.domElem[0].scrollHeight ) {
						  // Скролл достиг низа.
						  event.data.mythis._nextPaginator();
						}
					  });
					}

					// Вставка привязанным к пагинатору блоком "paste" html-кода.
					if ( this.params.channel ) {
						channels( this.params.channel ).on( 'insert', { mythis : this }, function( event ) {
							let page = event.data.mythis.findChildElem( 'page' );
							if ( page ) {
								channels( event.data.mythis.params.channel ).emit( 'init' );
							}
							else {
								channels( event.data.mythis.params.channel ).emit( 'reset' );
							}
						});
					}

				}
			}
		},

		/**
		 * Создаёт событие именного канала на получение следующей порции данных пагинации.
		 */
		_nextPaginator: function() {
			// Определяем значение скрытого поля "input", которое содержит значение "url" c "get" параметром "page".
			let page = this.findChildElem( 'page' );
			if ( page && this.params.channelnext ) {
				channels( this.params.channelnext ).emit( 'next', page.domElem.find( 'input[name="page"]' ).val() );
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
