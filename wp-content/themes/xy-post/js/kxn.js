;(function($, undefined){

    function KxnSyncAll(){
        var This = this;

        this.currentPostId = null;
        this.syncAttempts = 0;
        this.syncAttemptLimit = 2;
        this.getPreviousPostErrors = 0;
        this.getPreviousPostErrorLimit = 2;

        this.init = function(){

            var $logCont = jQuery('#status-log');

            if ($logCont.length){

                var postId = $logCont.attr('data-last-post');

                if ( postId ){

                    This.currentPostId = postId;
                    This.syncPost( postId );

                }
            }

        };

        this.syncPost = function( postId, onSuccess, onError ){
            This.syncAttempts++;
            $.ajax({
                url: kxnGlobal.ajaxurl,
                method: "POST",
                data: {
                    'action':'kxn_sync_post',
                    'post_id' : postId
                },
                dataType: "json",
                success: function( data ){

                    console.log(data);

                    if ( typeof onSuccess == 'function' ){
                        onSuccess( data );
                    }else{

                        if ( data.status ){
                            This.updateDisplayLog('<p>OK: '+postId+'</p>');
                            This.syncPreviousPost(data.previous_post_id);
                        }else if ( This.syncAttempts <  This.syncAttemptLimit ){
                            This.syncPost(postId);
                        }else{
                            This.updateDisplayLog('<p>Error: '+postId+'</p>');
                            This.syncPreviousPost(data.previous_post_id);
                        }

                    }

                },
                error: function( jqXHR, textStatus, errorThrown ){

                    if ( typeof onError == 'function' ){
                        onError();
                    }else{
                        This.getPreviousPost(postId, function(data){
                            This.syncPost( data.post_id );
                        }, function(){
                            
                        });
                    }
                    
                },
            });

        };

        this.syncPreviousPost = function( postId ){
            if ( typeof postId != 'undefined' && postId ){
                This.syncAttempts = 0;
                This.getPreviousPostErrors = 0;
                This.syncPost( postId );
            }
        };

        this.updateDisplayLog = function( txtLog ){
            jQuery('#status-log').append( txtLog );
        };

        this.getPreviousPost = function( postId, onSuccess, onError ){

            $.ajax({
                url: kxnGlobal.ajaxurl,
                method: "POST",
                data: {
                    'action':'kxn_sync_get_previous_post',
                    'post_id' : postId
                },
                dataType: "json",
                success: function( data ){

                    console.log(data);

                    if ( typeof onSuccess == 'function' ){
                        onSuccess( data );
                    }else{
                        if ( data.previous_post_id ){
                            This.syncPreviousPost( data.previous_post_id );
                        }
                    }
                },
                error: function( jqXHR, textStatus, errorThrown ){
                    if ( typeof onError == 'function' ){
                        onError( postId, jqXHR, textStatus, errorThrown );
                    }else{
                        This.getPreviousPostErrors++;
                        if ( This.getPreviousPostErrors <=  This.getPreviousPostErrorLimit ){
                            This.getPreviousPost(postId);
                        }
                    }
                },
            });
        };

        this.init();
    }

    $(document).ready(function(){

        var kxnSyncAll = new KxnSyncAll();

    });

})(jQuery); 