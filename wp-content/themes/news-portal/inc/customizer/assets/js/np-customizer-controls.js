/**
 * Scripts for Customizer Control
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.0.0
 */

( function( api ) {

/*------------------------ Upsell Section ------------------------*/

    api.sectionConstructor['mt-upsell'] = api.Section.extend( {

        // No events for this type of section.
        attachEvents: function () {},

        // Always make the section active.
        isContextuallyActive: function () {
            return true;
        }
    } );


/*------------------------ Heading Toggle Section -------------------*/

    wp.customize.bind('ready', function () {

        const controlsArray = [
            'news_portal_page_sidebar_heading_toggle',
            'news_portal_post_sidebar_heading_toggle',
        ];

        controlsArray.forEach(function (control) {
            if ( ! wp.customize.control(control).params.initial ) {
                var _this = wp.customize.control(control).container;
                _this.find(".toggle-button .dashicons").removeClass("dashicons-arrow-up-alt2").addClass("dashicons-arrow-down-alt2");
                _this.nextUntil(".customize-control-mt-heading-toggle").hide();
            }
        });

    });

} )( wp.customize );

jQuery(document).ready(function($) {

    "use strict";

/*------------------------ Radio Image Control ------------------------*/
    
    $( '.customize-control-radio-image .buttonset' ).buttonset();

    // Handles setting the new value in the customizer.
    $( '.customize-control-radio-image input:radio' ).change(
        function() {

            // Get the name of the setting.
            var setting = $( this ).attr( 'data-customize-setting-link' );

            // Get the value of the currently-checked radio input.
            var image = $( this ).val();

            // Set the new value.
            wp.customize( setting, function( obj ) {

                obj.set( image );
            } );
        }
    );

/*------------------------ Repeater Control ------------------------*/

    function news_portal_refresh_repeater_values(){
        $(".np-repeater-field-control-wrap").each(function(){
            
            var values = []; 
            var $this = $(this);
            
            $this.find(".np-repeater-field-control").each(function(){
            var valueToPush = {};   

            $(this).find('[data-name]').each(function(){
                var dataName = $(this).attr('data-name');
                var dataValue = $(this).val();
                valueToPush[dataName] = dataValue;
            });

            values.push(valueToPush);
            });

            $this.next('.np-repeater-collector').val(JSON.stringify(values)).trigger('change');
        });
    }

    $('#customize-theme-controls').on('click','.np-repeater-field-title',function(){
        $(this).next().slideToggle();
        $(this).closest('.np-repeater-field-control').toggleClass('expanded');
    });

    $('#customize-theme-controls').on('click', '.np-repeater-field-close', function(){
        $(this).closest('.np-repeater-fields').slideUp();;
        $(this).closest('.np-repeater-field-control').toggleClass('expanded');
    });

    $("body").on("click",'.np-repeater-add-control-field', function(){

        var fLimit = $(this).parent().find('.field-limit').val();
        var fCount = $(this).parent().find('.field-count').val();
        if( fCount < fLimit ) {
            fCount++;
            $(this).parent().find('.field-count').val(fCount);
        } else {
            $(this).before('<span class="np-limit-msg"><em>Only '+fLimit+' repeater field will be permitted.</em></span>');
            return;
        }

        var $this = $(this).parent();
        if(typeof $this != 'undefined') {

            var field = $this.find(".np-repeater-field-control:first").clone();
            if(typeof field != 'undefined'){
                
                field.find("input[type='text'][data-name]").each(function(){
                    var defaultValue = $(this).attr('data-default');
                    $(this).val(defaultValue);
                });
                
                field.find(".np-repeater-icon-list").each(function(){
                    var defaultValue = $(this).next('input[data-name]').attr('data-default');
                    $(this).next('input[data-name]').val(defaultValue);
                    $(this).prev('.np-repeater-selected-icon').children('i').attr('class','').addClass(defaultValue);
                    
                    $(this).find('li').each(function(){
                        var icon_class = $(this).find('i').attr('class');
                        if(defaultValue == icon_class ){
                            $(this).addClass('icon-active');
                        }else{
                            $(this).removeClass('icon-active');
                        }
                    });
                });

                field.find('.np-repeater-fields').show();

                $this.find('.np-repeater-field-control-wrap').append(field);

                field.addClass('expanded').find('.np-repeater-fields').show(); 
                $('.accordion-section-content').animate({ scrollTop: $this.height() }, 1000);
                news_portal_refresh_repeater_values();
            }

        }
        return false;
     });
    
    $("#customize-theme-controls").on("click", ".np-repeater-field-remove",function(){
        if( typeof  $(this).parent() != 'undefined'){
            $(this).closest('.np-repeater-field-control').slideUp('normal', function(){
                $(this).remove();
                news_portal_refresh_repeater_values();
            });
        }
        return false;
    });

    $("#customize-theme-controls").on('keyup change', '[data-name]',function(){
        news_portal_refresh_repeater_values();
        return false;
    });

    //Drag and drop to change order
    $(".np-repeater-field-control-wrap").sortable({
        orientation: "vertical",
        update: function( event, ui ) {
            news_portal_refresh_repeater_values();
        }
    });

    $('body').on('click', '.np-repeater-icon-list li', function(){
        var icon_class = $(this).find('i').attr('class');
        $(this).addClass('icon-active').siblings().removeClass('icon-active');
        $(this).parent('.np-repeater-icon-list').prev('.np-repeater-selected-icon').children('i').attr('class','').addClass(icon_class);
        $(this).parent('.np-repeater-icon-list').next('input').val(icon_class).trigger('change');
        news_portal_refresh_repeater_values();
    });

    $('body').on('click', '.np-repeater-selected-icon', function(){
        $(this).next().slideToggle();
    });

    //Image selector
    $('body').on('click','.selector-labels label', function(){
        var $this = $(this);
        var value = $this.data('val');
        $this.closest('.selector-labels').next('input').val(value).trigger('change');
    });
    
});