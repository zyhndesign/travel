<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ty
 * Date: 14-10-6
 * Time: 上午8:56
 * To change this template use File | Settings | File Templates.
 */
include(get_template_directory()."/zy_pages/controller/class_zy_page_helper.php");
class Zy_Box {

    const ZY_COMPRESS_SUFFIX="_zy_compress";

    /**
     * 增加缩略图页面,如果action里面直接用的类名而不是对象，这里面就不能使用$this
     * 就无需继承,此处还刷出了所有上传的媒体文件
     * @param object $post 文章对象
     */
    public function zy_post_thumb_box($post){

        $zy_help=new zy_articles_help_class();

        //获取原来的缩略图
        $zy_old_thumb=$zy_help->zy_get_old_thumb($post->ID);

        //获取已经上传的媒体文件
        $zy_help->zy_get_post_medias($post->ID);

        $edit_time=get_post_meta($post->ID,"_edit_lock",true);

        if($edit_time){
            echo "<input type='hidden' name='_edit_lock' value='$edit_time'>";
        }

        ?>

        <input type='hidden' id="zy_medias" name="zy_medias">

        <div id='zy_thumb_container'>

            <div class="zy_post_div"><input id="zy_upload_thumb_button" type="button" class="zy_post_button" value="上传">

                <span style="display: block">限高宽比为1：1的jpg或png</span>

            </div>

            <img id="zy_uploaded_thumb" src="<?php

            if($zy_old_thumb){

                //显示压缩后的图片

                $zy_help->zy_get_compress_thumb($zy_old_thumb["filepath"]);

            }else{

                echo get_template_directory_uri()."/images/app/zy_default_thumb.png";

            }

            ?>" class="zy_post_img">

        </div>

    <?php

    }


    /**
     * 增加背景图
     * @param object $post 文章对象
     */
    public function zy_post_background_box($post){

        $zy_help=new zy_articles_help_class();


        ?>

        <div id='zy_background_container'>

            <div class="zy_post_div"><input id="zy_upload_background_button" type="button" class="zy_post_button" value="上传">

                <input id="zy_upload_background_clear" type="button" class="zy_post_button" value="清除">

                <span style="display: block">限jpg、png、mp4，分辨率1280*720</span>

                <span id="zy_background_percent" class="zy_background_percent"></span>

            </div>

            <?php
            //获取原来的背景
            $zy_help->zy_get_old_background($post->ID);

            ?>

        </div>

    <?php

    }
}