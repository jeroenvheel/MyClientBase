/**
 * jQuery-Plugin "relCopy"
 *
 * @version: 1.0.1, 15.12.2009
 *
 * @author: Andres Vidal
 *          code@andresvidal.com
 *          http://www.andresvidal.com
 *
 * Instructions: Call $(selector).relCopy(options) on an element with a jQuery type selector
 * defined in the attribute "rel" tag. This defines the DOM element to copy.
 * @example: $('a.copy').relCopy({limit: 5}); // <a href="example.com" class="copy" rel=".phone">Copy Phone</a>
 *
 * @param: string	excludeSelector - A jQuery selector used to exclude an element and its children
 * @param: integer	limit - The number of allowed copies. Default: 0 is unlimited
 * @param: string	append - HTML to attach at the end of each copy. Default: remove link
 * @param: string	copyClass - A class to attach to each copy
 * @param: boolean	clearInputs - Option to clear each copies text input fields or textarea
 *
 */

(function($) {

	$.fn.relCopy = function(options) {
		var settings = jQuery.extend({
			excludeSelector: ".exclude",
			emptySelector: ".empty",
			copyClass: "copy",
			append: '',
			clearInputs: true,
			limit: 0 // 0 = unlimited
		}, options);

		settings.limit = parseInt(settings.limit);

		// loop each element
		this.each(function() {

			// set click action
			$(this).click(function(){
				var rel = $(this).attr('rel'); // rel in jquery selector format
				var counter = $(rel).length;

				// stop limit
				if (settings.limit != 0 && counter >= settings.limit){
					return false;
				};

				var master = $(rel+":first");
				var parent = $(master).parent();
				var clone = $(master).clone(true).addClass(settings.copyClass+counter).append(settings.append);

				//Remove Elements with excludeSelector
				if (settings.excludeSelector){
					$(clone).find(settings.excludeSelector).remove();
				};

				//Empty Elements with emptySelector
				if (settings.emptySelector){
					$(clone).find(settings.emptySelector).empty();
				};

				// Increment Clone IDs
				if ( $(clone).attr('id') ){
					var newid = $(clone).attr('id') + (counter +1);
					$(clone).attr('id', newid);
				};

				// Increment Clone Children IDs
				$(clone).find('[id]').each(function(){
					var newid = $(this).attr('id') + (counter +1);
					$(this).attr('id', newid);
				});

				//Clear Inputs/Textarea
				if (settings.clearInputs){
					$(clone).find('input:text, textarea').each(function(){
						$(this).val("");
					});
				};

				$(parent).find(rel+':last').after(clone);

				return false;

			}); // end click action

		}); //end each loop

		return this; // return to jQuery
	};

})(jQuery);


//
////$(document).ready(function() {
//
//	$('#btn_add_tax_rate').click(function() {
//		var num		= $('.cloned_input').length;	// how many "duplicatable" input fields we currently have
//		var newNum	= new Number(num + 1);		// the numeric ID of the new input field being added
//
//		// create the new element via clone(), and manipulate it's ID using newNum value
//		var newElem = $('#input' + num).clone().attr('id', 'input' + newNum);
//
//		// manipulate the name/id values of the input inside the new element
//		newElem.children(':first').attr('id', 'tax_rate_id_' + newNum);
//
//		// insert the new element after the last "duplicatable" input field
//		$('#input' + num).after(newElem);
//
//		// enable the "remove" button
//		$('#btn_remove_tax_rate').attr('disabled','');
//
//		// business rule: you can only add 5 names
//		if (newNum == 5)
//			$('#btn_add_tax_rate').attr('disabled','disabled');
//	});
//
//	$('#btn_remove_tax_rate').click(function() {
//		var num	= $('.cloned_input').length;	// how many "duplicatable" input fields we currently have
//		$('#input' + num).remove();		// remove the last element
//
//		// enable the "add" button
//		$('#btn_add_tax_rate').attr('disabled','');
//
//		// if only one element remains, disable the "remove" button
//		if (num-1 == 1)
//			$('#btn_remove_tax_rate').attr('disabled','disabled');
//	});
//
//	$('#btn_remove_tax_rate').attr('disabled','disabled');
//});