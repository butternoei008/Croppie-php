<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/croppie/croppie.css">
</head>
<body>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="text-center">
                    Image upload
                </div>
            </div>
            <div class="card-body">
                <input type="file" class="form-control-file" accept="image/*" name="img_upload" id="img_upload" required>
                <div class="text-center mt-2">
                    <div id="img_uploaded"></div>
                </div>
            </div>
            <div class="card-footer text-center">
            </div>
        </div>
    </div>

    <div id="imgUploadModal" class="modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    Upload image<button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="img_demo" class="mt-2"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success crop_img">Upload</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
   
</div>

    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/croppie/croppie.js"></script>
    <script>
        $( document ).ready( function(){ 
                        
            $img_crop = $( '#img_demo' ).croppie({
                enableExif: true,
                viewport: {
                    width: 200,
                    height: 200,
                    type: 'square'
                },
                boundary: {
                    width: 300,
                    height: 300
                }
            });

            $( '#img_upload' ).on( 'change', function(){
                var reader = new FileReader();
                reader.onload = function( e ){
                    $img_crop.croppie( 'bind', {
                        url: e.target.result
                    }).then( function() {
                        console.log( "Jquery bind complete" );
                    });
                }
                reader.readAsDataURL( this.files[0] );
                $( '#imgUploadModal' ).modal( 'show' );
            });

            $( '.crop_img' ).click( function( e ){
                $img_crop.croppie( 'result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then( function(response){
                    $.ajax({
                        url: 'img_upload.php',
                        type: 'POST',
                        data:{
                            "image" : response
                        },
                        success: function(data){
                            $( '#imgUploadModal' ).modal( 'hide' );
                            $( '#img_uploaded' ).html( data );
                        }
                    })
                });
            });
        });
    </script>
</body>
</html>
