(function() {
	tinymce.PluginManager.add('mystem_extras_button', function( editor, url ) { 
		editor.addButton( 'mystem_extras_button', {			 
			type: 'menubutton',
			title: 'MyStem Extra', 
			image: url + '/icon.png',
			menu: [ 				
				{
					text: 'Colomn',
					menu: [ 
						{
							text: 'Two colomns',
							onclick: function() {
								editor.insertContent('[row][column]<h4>Your content 1</h4><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eget orci ac lacus laoreet condimentum eget vel risus. Ut vel dolor sed lorem consectetur volutpat.</p>[/column][column]<h4>Your content 2<p>Curabitur eget posuere arcu. Morbi egestas tellus lacus, quis rutrum nunc egestas in. Pellentesque gravida ipsum ac ligula malesuada, sed pharetra elit hendrerit.</p></h4>[/column][/row]');
							}
						},
						{
							text: 'Three columns',
							onclick: function() {
								editor.insertContent('[row][column]<h4>Your content 1</h4><p>Curabitur lacinia mattis euismod. Aenean tristique lorem nisi, ac fringilla tellus accumsan at.</p>[/column][column]<h4>Your content 2</h4><p>Quisque scelerisque, nisi ultrices fermentum consequat, dui tellus suscipit massa, ultrices hendrerit ligula mi quis erat. In elit lectus, faucibus mattis felis in, pellentesque maximus arcu.</p>[/column][column]<h4>Your content 3</h4><p>Quisque ac dui eget eros condimentum vulputate. Suspendisse porta mi eget posuere vulputate.</p>[/column][/row]');
							}
						},
						{
							text: 'Four columns',
							onclick: function() {
								editor.insertContent('[row][column]<h4>Your content 1</h4><p>Suspendisse eget ligula sit amet neque hendrerit finibus. Phasellus felis sem, aliquam eu odio ac, tempus tincidunt turpis. Proin condimentum lectus non laoreet congue.</p>[/column][column]<h4>Your content 2</h4><p>Fusce non massa molestie nisl porttitor rhoncus. Donec rhoncus posuere leo ut rutrum. Sed id porttitor dui. </p>[/column][column]<h4>Your content 3</h4><p>Proin auctor, leo eu placerat convallis, lacus tellus feugiat tortor, quis auctor justo augue at ipsum. Donec in dapibus diam. Nullam nec accumsan eros, eu condimentum tortor. </p>[/column][column]<h4>Your content 4</h4><p>Cras at lectus id nisl ultricies eleifend consectetur sit amet justo. Fusce velit metus, varius eget hendrerit in, mollis bibendum est.</p>[/column][/row]');
							}
						},
					]
				},
				
				{
					text: 'Tabs',
					menu: [ 
						{
							text: 'Tab',
							onclick: function() {
								editor.insertContent('[tabs][tab title=\"Tab One\"]<h3>Here is tab one content.</h3><p>Duis turpis nisl, mattis a risus porttitor, laoreet vulputate libero. Fusce quis erat vitae arcu aliquam interdum eget non lectus. Vivamus convallis purus ac enim fringilla, nec luctus ipsum iaculis. Proin nunc augue, ornare ac mollis at, convallis eu diam. Aenean vulputate sit amet massa sit amet ultricies.</p>[/tab][tab title=\"Tab Two\"]<h3>Here is tab two content.</h3><p>Aenean mattis nisi nisl, sed sollicitudin nisi suscipit id. Pellentesque ac varius sem. Proin elementum semper massa eget posuere. Nunc vitae nulla sit amet ante sodales condimentum. Quisque lacinia nec ex vel iaculis. Praesent dignissim urna eu ligula hendrerit, sed dictum lectus scelerisque.</p> [/tab][tabs]');
							}
						},
						{
							text: 'Tab left',
							onclick: function() {
								editor.insertContent('[tabs style=\"tabs-left\"][tab title=\"Tab One\"]<h3>Here is tab one content.</h3><p>Duis turpis nisl, mattis a risus porttitor, laoreet vulputate libero. Fusce quis erat vitae arcu aliquam interdum eget non lectus. Vivamus convallis purus ac enim fringilla, nec luctus ipsum iaculis. Proin nunc augue, ornare ac mollis at, convallis eu diam. Aenean vulputate sit amet massa sit amet ultricies.</p>[/tab][tab title=\"Tab Two\"]<h3>Here is tab two content.</h3><p>Aenean mattis nisi nisl, sed sollicitudin nisi suscipit id. Pellentesque ac varius sem. Proin elementum semper massa eget posuere. Nunc vitae nulla sit amet ante sodales condimentum. Quisque lacinia nec ex vel iaculis. Praesent dignissim urna eu ligula hendrerit, sed dictum lectus scelerisque.</p>[/tab][/tabs]');
							}
						},
						{
							text: 'Tab right',
							onclick: function() {
								editor.insertContent('[tabs style=\"tabs-right\"][tab title=\"Tab One\"]<h3>Here is tab one content.</h3><p>Duis turpis nisl, mattis a risus porttitor, laoreet vulputate libero. Fusce quis erat vitae arcu aliquam interdum eget non lectus. Vivamus convallis purus ac enim fringilla, nec luctus ipsum iaculis. Proin nunc augue, ornare ac mollis at, convallis eu diam. Aenean vulputate sit amet massa sit amet ultricies.</p>[/tab][tab title=\"Tab Two\"]<h3>Heading Two</h3><p>Aenean mattis nisi nisl, sed sollicitudin nisi suscipit id. Pellentesque ac varius sem. Proin elementum semper massa eget posuere. Nunc vitae nulla sit amet ante sodales condimentum. Quisque lacinia nec ex vel iaculis. Praesent dignissim urna eu ligula hendrerit, sed dictum lectus scelerisque.</p>[/tab][/tabs]');
							}
						},
					]
				},
				
				{
					text: 'Toggle',
					onclick: function() {
						editor.insertContent('[toggle title=\"I\'m Tooggle - click me\"]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non aliquet elit. Nam id laoreet diam. Etiam id ornare erat, ac eleifend velit. Vivamus cursus sagittis odio a condimentum. Nullam et libero et massa laoreet blandit. Sed dapibus vestibulum turpis sagittis dapibus. Praesent vitae diam commodo, malesuada est at, eleifend metus. Suspendisse vitae augue lobortis, bibendum mauris at, ullamcorper nibh. Sed semper dignissim urna vestibulum lobortis.[/toggle]');
					}
				},		
				
				{
					text: 'Accordion / FAQ',
					onclick: function() {
						editor.insertContent('[accordion][accordion_block title=\"Question 1\"]<h3>Answer 1.</h3><p>Proin pharetra in nisi at interdum. Fusce rhoncus lacinia enim, blandit porta diam lacinia a. Proin quis vehicula velit. Sed malesuada ex et arcu feugiat feugiat. Morbi convallis hendrerit metus id maximus.</p>[/accordion_block][accordion_block title=\"Question 2\"]<h3>Answer 2.</h3><p>Aliquam convallis ullamcorper nulla, ac rutrum nulla varius ut. Maecenas gravida nisl sit amet elit accumsan pellentesque. Proin volutpat vestibulum risus, at volutpat nibh interdum vel. Curabitur blandit enim nulla, sit amet tristique nisl rhoncus egestas.</p>[/accordion_block][accordion_block title=\"Question 3\"]<h3>Answer 3.</h3><p>Fusce quis erat vitae arcu aliquam interdum eget non lectus. Vivamus convallis purus ac enim fringilla, nec luctus ipsum iaculis. Proin nunc augue, ornare ac mollis at, convallis eu diam. Aenean vulputate sit amet massa sit amet ultricies.</p>[/accordion_block][/accordion]');
					}
				},											
				{
					text: 'Alerts',
					menu: [ 
						{
							text: 'Info',
							onclick: function() {
								editor.insertContent('[alert type="info"]Replace this text with your own text.[/alert]');
							}
						},
						{
							text: 'Success',
							onclick: function() {
								editor.insertContent('[alert type="success"]Replace this text with your own text.[/alert]');
							}
						},
						{
							text: 'Warning',
							onclick: function() {
								editor.insertContent('[alert type="warning"]Replace this text with your own text.[/alert]');
							}
						},
						{
							text: 'Error',
							onclick: function() {
								editor.insertContent('[alert type="error"]Replace this text with your own text.[/alert]');
							}
						},
					]
				},			
				
			]
		});
	});
})();