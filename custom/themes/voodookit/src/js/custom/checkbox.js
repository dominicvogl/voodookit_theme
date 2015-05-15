//
// checkbox.js
// Author: BERGWERK (dv)
// --------------------------------------------------------------------------

$(document).ready(function () {

   var checkbox = $('.checkbox');
   var radio = $('.radio');

   if (checkbox.length)
   {
      checkbox.each(function ()
      {
         setCheckBox($(this));
      });
   }

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