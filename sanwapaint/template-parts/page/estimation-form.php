<?php

$wall_dimens = get_estimation_dimens('est-cat-01');
$roof_dimens = get_estimation_dimens('est-cat-02');
$materials = get_estimation_materials();

?>


<!--estimation-->
<div id="wholeContents" class="wholeContents page-php" role="main">
  <div id="secondLayer" class="secondLayer">

    <div id="mainContents" class="mainContents">


      <div id="contentsWrapper" class="contentsWrapper">
        <div id="main" class="main-content">


          <!--content page-->
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <div class="entry-content">
              <div class="wpb_text_column wpb_content_element  A01_inner">
                  <div class="wpb_wrapper">
                    <h2 class="style02">お客様の外壁の面積をご入力ください</h2>

                  </div>
                </div>


              <div class="estimationInner">
                <div class="tab_wrap">
                  <input id="tab1" type="radio" name="tab_btn" checked>
                  <input id="tab2" type="radio" name="tab_btn">
                  <input id="tab3" type="radio" name="tab_btn">

                  <div class="tab_area">
                    <label class="tab1_label" for="tab1">外壁のみ</label>
                    <label class="tab2_label" for="tab2">外壁+屋根</label>
                    <label class="tab3_label" for="tab3">屋根のみ</label>
                  </div>
                  <div class="panel_area">
                    <div id="panel1" class="tab_panel">

                      <form id="estimation_form1" action="<?php echo esc_url( home_url( '/simple-estimation-result' ) ); ?>" method="post">

                        <div class="esti_main_form">

                          <div class="esti_form_title">
                            <p><strong>外壁</strong>のみの料金シミュレーションが行えます。</p>
                            <!-- <p>お客様の<strong>外壁</strong>の面積をご入力ください。</p> -->
                          </div>

                          <div class="esti_form_body">
                            <h3 class="label">外壁</h3>
                            <div class="esti_form_item left gaiheki">
<!--                               <div class="step">
                                <p>Step1.お客様の家の外壁の大きさをお教えください。</p>
                              </div> -->
                              <div class="esti_form_label">
                                <label>Step1 外壁の大きさ（おおよそ）</label>
                              </div>
                              <div class="esti_form_input">
                                <select  class="" name="wall_dimen" id="wall_dimen">
                                  <option value="">選択ください</option>
                                  <?php foreach ($wall_dimens as $wall_dimen) { ?>
                                  <option value="<?=$wall_dimen?>" ><?=$wall_dimen?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <!-- esti_form_item left gaiheki -->


                            <div class="esti_form_item right gaihekiToryo">
<!--                               <div class="step">
                                <p>Step2.外壁に使う塗料のグレードをお選びください。</p>
                              </div> -->
                              <div class="esti_form_label">
                                <label>Step2 塗料ランク</label>
                              </div>
                              <div class="esti_form_input">
                                <select  class="" name="wall_material" id="wall_material">
                                  <option value="">選択ください</option>
                                  <?php foreach ($materials as $material) { ?>
                                  <option value="<?=$material['field']?>"><?=$material['label']?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div class="clearfix"></div>
                            </div>

                            <!-- esti_form_item right gaihekiToryo -->



                            <div class="esti_form_item left yane">
                              <div class="esti_form_label">
                                <label>屋根の大きさ（おおよそ）</label>
                              </div>
                              <div class="esti_form_input">
                                <select  class="" name="roof_dimen" id="roof_dimen">
                                  <option value="">選択ください</option>
                                  <?php foreach ($roof_dimens as $roof_dimen) { ?>
                                  <option value="<?=$roof_dimen?>" ><?=$roof_dimen?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <!-- esti_form_item left yane -->


                            <div class="esti_form_item right yaneToryo">
                              <div class="esti_form_label">
                                <label>塗料ランク</label>
                              </div>
                              <div class="esti_form_input">
                                <select  class="" name="roof_material" id="roof_material">
                                  <option value="">選択ください</option>
                                  <?php foreach ($materials as $material) { ?>
                                  <option value="<?=$material['field']?>"><?=$material['label']?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>

                            <!-- esti_form_item right yaneToryo -->


                        <div class="rem5 errmessage"></div>
                        <?php get_template_part( 'template-parts/page/price', 'letter' ); ?>




                        <!--button-->
                        <div class="vc_row wpb_row vc_inner vc_row-fluid">
                          <div class="co1 wpb_column vc_column_container vc_col-sm-2">
                            <div class="vc_column-inner">
                              <div class="wpb_wrapper"></div>
                            </div>
                          </div>
                          <div class="co2 wpb_column vc_column_container vc_col-sm-8">
                            <div class="vc_column-inner">
                              <div class="wpb_wrapper">
                                <div class="vc_btn3-container  submitBtn btnWrapper btns btn2 vc_btn3-center">
                                  <button class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-flat vc_btn3-block vc_btn3-icon-right vc_btn3-color-sky" id="esti-search-btn1" type="submit" onClick="return empty1()">シミュレーション開始</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="co3 wpb_column vc_column_container vc_col-sm-2">
                            <div class="vc_column-inner">
                              <div class="wpb_wrapper"></div>
                            </div>
                          </div>
                        </div>


                          <?php
                          //main_func.phpに記述
                           echo do_shortcode('[simulation_text]') ?>




                          </div>
                          <!-- esti_form_body -->

                        </div>
                        <!-- esti_main_form -->





                      </form>
                    </div>
                    <div id="panel2" class="tab_panel">



                      <form id="estimation_form2" action="<?php echo esc_url( home_url( '/simple-estimation-result' ) ); ?>" method="post">

                        <div class="esti_main_form">

                          <div class="esti_form_title">
                            <p><strong>外壁</strong>と<strong>屋根</strong>の料金シミュレーションが行えます</p>
                            <!-- <p>お客様の<strong>外壁</strong>と<strong>屋根</strong>の面積をご入力ください。</p> -->
                          </div>

                          <div class="esti_form_body">
                            <h3 class="label">外壁</h3>

                            <div class="esti_form_item left gaiheki">
<!--                               <div class="step">
                                <p>Step1.お客様の家の外壁の大きさをお教えください。</p>
                              </div> -->
                              <div class="esti_form_label">
                                <label>Step1 外壁の大きさ（おおよそ）</label>
                              </div>
                              <div class="esti_form_input">
                                <select  class="" name="wall_dimen" id="wall_dimen">
                                  <option value="">選択ください</option>
                                  <?php foreach ($wall_dimens as $wall_dimen) { ?>
                                  <option value="<?=$wall_dimen?>" ><?=$wall_dimen?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="esti_form_item right gaihekiToryo">
<!--                               <div class="step">
                                <p>Step2.外壁に使う塗料のグレードをお選びください。</p>
                              </div> -->
                              <div class="esti_form_label">
                                <label>Step2 塗料ランク</label>
                              </div>
                              <div class="esti_form_input">
                                <select  class="" name="wall_material" id="wall_material">
                                  <option value="">選択ください</option>
                                  <?php foreach ($materials as $material) { ?>
                                  <option value="<?=$material['field']?>"><?=$material['label']?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div class="clearfix"></div>
                            </div>


                              <h3 class="label">屋根</h3>

                            <div class="esti_form_item left yane">
<!--                               <div class="step">
                                <p>Step3.お客様の家の屋根の大きさをお教えください。</p>
                              </div> -->
                              <div class="esti_form_label">
                                <label>Step3 屋根の大きさ（おおよそ）</label>
                              </div>
                              <div class="esti_form_input">
                                <select  class="" name="roof_dimen" id="roof_dimen">
                                  <option value="">選択ください</option>
                                  <?php foreach ($roof_dimens as $roof_dimen) { ?>
                                  <option value="<?=$roof_dimen?>" ><?=$roof_dimen?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="esti_form_item right yaneToryo">
<!--                               <div class="step">
                                <p>Step4.屋根に使う塗料のグレードをお選びください。</p>
                              </div> -->
                              <div class="esti_form_label">
                                <label>Step4 塗料ランク</label>
                              </div>
                              <div class="esti_form_input">
                                <select  class="" name="roof_material" id="roof_material">
                                  <option value="">選択ください</option>
                                  <?php foreach ($materials as $material) { ?>
                                  <option value="<?=$material['field']?>"><?=$material['label']?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div class="clearfix"></div>
                            </div>


                        <div class="rem5 errmessage"></div>
                        <?php get_template_part( 'template-parts/page/price', 'letter' ); ?>

                        <!--button-->
                        <div class="vc_row wpb_row vc_inner vc_row-fluid">
                          <div class="co1 wpb_column vc_column_container vc_col-sm-2">
                            <div class="vc_column-inner">
                              <div class="wpb_wrapper"></div>
                            </div>
                          </div>
                          <div class="co2 wpb_column vc_column_container vc_col-sm-8">
                            <div class="vc_column-inner">
                              <div class="wpb_wrapper">
                                <div class="vc_btn3-container  submitBtn btnWrapper btns btn2 vc_btn3-center">
                                  <button class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-flat vc_btn3-block vc_btn3-icon-right vc_btn3-color-sky" id="esti-search-btn2" type="submit" onClick="return empty2()">シミュレーション開始</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="co3 wpb_column vc_column_container vc_col-sm-2">
                            <div class="vc_column-inner">
                              <div class="wpb_wrapper"></div>
                            </div>
                          </div>
                        </div>





                          <?php
                          //main_func.phpに記述
                           echo do_shortcode('[simulation_text]') ?>


                          </div>

                        </div>

                        <?php //get_template_part( 'template-parts/page/price', 'letter' ); ?>




                      </form>


                    </div>
                    <div id="panel3" class="tab_panel">


                      <form id="estimation_form3" action="<?php echo esc_url( home_url( '/simple-estimation-result' ) ); ?>" method="post">

                        <div class="esti_main_form">

                          <div class="esti_form_title">
                            <p><strong>屋根</strong>のみの料金シミュレーションが行えます</p>
                            <!-- <p>お客様の<strong>屋根</strong>の面積をご入力ください。</p> -->
                          </div>

                          <div class="esti_form_body">
                            <div class="esti_form_item left gaiheki">

                              <div class="esti_form_label">
                                <label>外壁の大きさ（おおよそ）</label>
                              </div>
                              <div class="esti_form_input">
                                <select  class="" name="wall_dimen" id="wall_dimen">
                                  <option value="">選択ください</option>
                                  <?php foreach ($wall_dimens as $wall_dimen) { ?>
                                  <option value="<?=$wall_dimen?>" ><?=$wall_dimen?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="esti_form_item right gaihekiToryo">
                              <div class="esti_form_label">
                                <label>塗料ランク</label>
                              </div>
                              <div class="esti_form_input">
                                <select  class="" name="wall_material" id="wall_material">
                                  <option value="">選択ください</option>
                                  <?php foreach ($materials as $material) { ?>
                                  <option value="<?=$material['field']?>"><?=$material['label']?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div class="clearfix"></div>
                            </div>


                              <h3 class="label">屋根</h3>

                            <div class="esti_form_item left yane">
<!--                               <div class="step">
                                <p>Step1 屋根の大きさ（おおよそ）</p>
                              </div> -->
                              <div class="esti_form_label">
                                <label>Step1 屋根の大きさ（おおよそ）</label>
                              </div>
                              <div class="esti_form_input">
                                <select  class="" name="roof_dimen" id="roof_dimen">
                                  <option value="">選択ください</option>
                                  <?php foreach ($roof_dimens as $roof_dimen) { ?>
                                  <option value="<?=$roof_dimen?>" ><?=$roof_dimen?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                            <div class="esti_form_item right yaneToryo">
<!--                               <div class="step">
                                <p>Step2.屋根に使う塗料のグレードをお選びください。</p>
                              </div> -->
                              <div class="esti_form_label">
                                <label>Step2 塗料ランク</label>
                              </div>
                              <div class="esti_form_input">
                                <select  class="" name="roof_material" id="roof_material">
                                  <option value="">選択ください</option>
                                  <?php foreach ($materials as $material) { ?>
                                  <option value="<?=$material['field']?>"><?=$material['label']?></option>
                                  <?php } ?>
                                </select>

                              </div>
                            </div>

                        <div class="rem5 errmessage"></div>
                            <?php get_template_part( 'template-parts/page/price', 'letter' ); ?>


                        <!--button-->
                        <div class="vc_row wpb_row vc_inner vc_row-fluid">
                          <div class="co1 wpb_column vc_column_container vc_col-sm-2">
                            <div class="vc_column-inner">
                              <div class="wpb_wrapper"></div>
                            </div>
                          </div>
                          <div class="co2 wpb_column vc_column_container vc_col-sm-8">
                            <div class="vc_column-inner">
                              <div class="wpb_wrapper">
                                <div class="vc_btn3-container  submitBtn btnWrapper btns btn2 vc_btn3-center">
                                  <button class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-flat vc_btn3-block vc_btn3-icon-right vc_btn3-color-sky" id="esti-search-btn3" type="submit" onClick="return empty3()">シミュレーション開始</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="co3 wpb_column vc_column_container vc_col-sm-2">
                            <div class="vc_column-inner">
                              <div class="wpb_wrapper"></div>
                            </div>
                          </div>
                        </div>




                          <?php
                          //main_func.phpに記述
                           echo do_shortcode('[simulation_text]') ?>


                          </div>

                        </div>

                        <?php //get_template_part( 'template-parts/page/price', 'letter' ); ?>



                      </form>
                    </div>
                  </div>
                </div>
              </div>


              <script type="text/javascript">
              function empty1() {
                  if ( $('#panel1 select[name="wall_dimen"]').val() == "" ||
                    $('#panel1 select[name="wall_material"]').val() == "" ) {
                    $("#panel1 #no_alert").hide();
                    $("#panel1 .rem5").append('<div id="no_alert" class="vc_row wpb_row vc_inner vc_row-fluid"><p>大きさ・塗料ランクをセットで入力してください</p></div>');
                    return false;
                  }
              }
              function empty2() {
                  if ( $('#panel2 select[name="wall_dimen"]').val() == "" ||
                    $('#panel2 select[name="wall_material"]').val() == "" ||
                    $('#panel2 select[name="roof_dimen"]').val() == "" ||
                    $('#panel2 select[name="roof_material"]').val() == "")
                  {
                    $("#panel2 #no_alert").hide();
                    $("#panel2 .rem5").append('<div id="no_alert" class="vc_row wpb_row vc_inner vc_row-fluid"><p>大きさ・塗料ランクをセットで入力してください</p></div>');
                    return false;
                  }
              }
              function empty3() {
                  if ( $('#panel3 select[name="roof_dimen"]').val() == "" ||
                    $('#panel3 select[name="roof_material"]').val() == "" )
                  {
                    $("#panel3 #no_alert").hide();
                    $("#panel3 .rem5").append('<div id="no_alert" class="vc_row wpb_row vc_inner vc_row-fluid"><p>大きさ・塗料ランクをセットで入力してください</p></div>');
                    return false;
                  }
              }
              </script>



            </div><!-- .entry-content -->

          </article><!-- #post-## -->


        </div>
      </div><!--contentsWrapper-->


    </div><!--#mainContents-->
  </div><!-- #secondLayer -->
</div><!--#wholeContents-->
