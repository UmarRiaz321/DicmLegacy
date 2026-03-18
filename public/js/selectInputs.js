$(function(){
    $( '#cse_Type' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        allowClear: true
    } );
    // cse_Theme

    $( '#cse_Theme' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        allowClear: true
    } );
    $( '#spo_Theme' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        allowClear: true
    } );

    $( '#ena_theme' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        allowClear: true
    } );

  




    $(document).ready(function(){

        // Current Support 

        $("#cse_CurrentSupporters").select2({
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: true,
            tags: true,
            tokenSeparators: [",", ";"],
      
        });

        //   Regions

        // let Regions = ["East Midlands","East of England","London","North East","North West","South East","South West","West Midlands","Yorks and Humber","Scotland","Wales","N. Ireland"]

        $( '#cse_Regions').select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: true,
            tokenSeparators: [",", ";"],
            // multiple: true,
            // data:Regions,
    
        } );

        // $('#cse_Regions').val(["East Midlands"]).trigger('change');

        $('#spo_Regions' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false
        } );

        // $('#spo_Regions').val(["East Midlands"]).trigger('change');

    
        $('#ena_regions' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false
        } );

        // $('#ena_regions').val(["East Midlands"]).trigger('change');

        // SPO SUPPLIER
        $("#spo_clients").select2({
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: true,
            tags: true,
            tokenSeparators: [",", ";"],
      
        });

        $("#spo_AccountSetup").select2({
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: true,      
        });

    })



    window.initProjectSelects = function(context){
        const $context = $(context || document);
        $context.find('.project-collect-data').each(function(){
            if ($(this).hasClass('select2-hidden-accessible')) {
                return;
            }
            $(this).select2({
                theme: "bootstrap-5",
                width: '100%',
                allowClear: true
            });
        });

        $context.find('.project-benefits-select').each(function(){
            if ($(this).hasClass('select2-hidden-accessible')) {
                return;
            }
            $(this).select2({
                theme: "bootstrap-5",
                width: '100%',
                allowClear: true,
                tags: true
            });
        });

        $context.find('.project-pcc-select').each(function(){
            if ($(this).hasClass('select2-hidden-accessible')) {
                return;
            }
            $(this).select2({
                theme: "bootstrap-5",
                width: '100%',
                allowClear: true
            });
        });
    };
    window.initProjectSelects(document);

    $( '#spo_FoundPluggin' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        allowClear: true
    } );
    // spo_OtherAccount
    $( '#spo_OtherAccount' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        allowClear: true
    } );

    // Enablers ena_ServiceType

    $( '#ena_ServiceType' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        allowClear: true
    } );

    // Confirmation


    $( '#ena_Confirmation' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        allowClear: true
    } );
})
