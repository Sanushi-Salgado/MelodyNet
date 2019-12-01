<!DOCTYPE html>
<html lang="en">

<head>
    <title>Melody Net</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="<?php echo base_url() . 'assets/img/icons/favicon.ico'; ?>" />

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap2.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">

    <script type=" text/javascript" src="<?php echo base_url('assets/js/bootstrap3.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.3.1.min.js'); ?>"></script>
    <script src="https://cdn.ckeditor.com/4.13.0/standard-all/ckeditor.js"></script>
</head>

<body>
    <div class="container">
        <h2>Create Post</h2> <br>

        <?php echo form_open_multipart('posts/create'); ?>

        <div class="form-group">
            <label>Post Content</label>
            <textarea cols="80" id="editor2" rows="10" data-sample-short name="post_content" class="form-control" placeholder="Enter description" required></textarea>
        </div>

        <div class="form-group">
            <label>Post Image</label>
            <input type="file" name="userfile" class="form-control btn btn-primary" size="20" accept="image/*">
        </div>
        <br>

        <button type="submit" class="text-center btn btn-info">Create Post</button>
        <a class="text-center btn btn-secondary" href="<?php base_url() . 'index.php/user/home'; ?>">Cancel</a>

        </form>
    </div>

    <script>
        /* CKEDITOR */
        CKEDITOR.replace('editor2', {
            // Upload images to a CKFinder connector (note that the response type is set to JSON).
            uploadUrl: '/apps/ckfinder/3.4.5/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',

            // Configure your file manager integration. This example uses CKFinder 3 for PHP.
            filebrowserBrowseUrl: '/apps/ckfinder/3.4.5/ckfinder.html',
            filebrowserImageBrowseUrl: '/apps/ckfinder/3.4.5/ckfinder.html?type=Images',
            filebrowserUploadUrl: '/apps/ckfinder/3.4.5/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl: '/apps/ckfinder/3.4.5/core/connector/php/connector.php?command=QuickUpload&type=Images',

            // The following options are not necessary and are used here for presentation purposes only.
            // They configure the Styles drop-down list and widgets to use classes.

            stylesSet: [{
                    name: 'Narrow image',
                    type: 'widget',
                    widget: 'image',
                    attributes: {
                        'class': 'image-narrow'
                    }
                },
                {
                    name: 'Wide image',
                    type: 'widget',
                    widget: 'image',
                    attributes: {
                        'class': 'image-wide'
                    }
                }
            ],

            // Load the default contents.css file plus customizations for this sample.
            contentsCss: [
                'http://cdn.ckeditor.com/4.13.0/full-all/contents.css',
                'assets/css/widgetstyles.css'
            ],

            // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
            // resizer (because image size is controlled by widget styles or the image takes maximum
            // 100% of the editor width).
            image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
            image2_disableResizer: true
        });
    </script>

</body>
</html>
    