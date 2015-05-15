/*
 * Checkbox Script
 * @file:    general.less
 * @author:  BERGWERK, [dv]
 */

$(document).ready(function ()
{

   var bwrk = {};
   bwrk.checkbox = $('.checkbox');
   bwrk.radio = $('.radio');

   if (bwrk.checkbox.length)
   {
      bwrk.checkbox.each(function ()
      {
         setCheckBox($(this));
      });
   }

   // Cleanup this stuff!
   setRadioButton();

});

//
// set the checkbox classes and attributes
// ------------------------------------------------------------

function setCheckBox(obj)
{

   if (obj.find('input').attr('checked') == true)
   {
      obj.addClass('active');
   }

   obj.find('input').on('click', function ()
   {

      if (!obj.hasClass('active'))
      {
         obj.addClass('active');
         obj.find('input').attr('checked', true);
      }
      else
      {
         obj.removeClass('active');
         obj.find('input').removeAttr('checked');
      }

   });
}

//
// set the radio button classes and attributes
// ------------------------------------------------------------

function setRadioButton()
{
   // Cleanup this stuff!
   var radio = $('.radio input');

   radio.click(function ()
   {
      var radioName = $(this).attr('name');
      $(this).parents('form').find('input[name="' + radioName + '"]').each(function ()
      {
         $(this).parents('.radio').removeClass('active');
         $(this).prop('checked', false);
      });

      $(this).parents('.radio').addClass('active');
      $(this).prop('checked', true);
   });
}