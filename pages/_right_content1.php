<div class="right_content_cont1">

    <div>

        <div class="myProfileDivCont forceStickBorderRad">
            <div> <span class="app_badge_1 mb_0sniS">Time:</span> <?php echo date("h:i:sa"); ?></div>
            <div> <span class="app_badge_1">Date:</span> <?php echo date("D, d/m/y"); ?></div>
        </div>
        <br />

        <div class="right_content_title">STRUCTURE <span class="col_grey">/</span> <span class="float_right col_blue2">1</span></div>

        <br />
        <div class="core_container">
            <div class="core_title">
                <div>CORE 1</div>
                <div></div>
            </div>
            <div class="core_content_flex">
                <?php
                for ($i = 0; $i < 50; $i++) {
                    $col_array = array("bg_colDarkGrey1", "bg_colGrey1", "bg_ColGreen4", "bg_ColYellow1", "bg_ColGreen3", "bg_ColPurple1", "bg_ColPink_colSet", "bg_ColRed_colSet", "bg_colGrey1", "bg_colDarkGrey1");
                    $col_array_len = count($col_array);
                    $col_rand = rand(1, $col_array_len);
                    $selected_col_no = $col_rand - 1;
                    $col_theme = $col_array[$selected_col_no];

                ?>
                    <div class="core_dot <?php echo $col_theme; ?>"></div>
                <?php
                }
                ?>
            </div>
        </div>

        <br />
        <br />
        <br />

        <div class="core_container">
            <div class="core_title">
                <div>CORE 2</div>
                <div></div>
            </div>
            <div class="core_content_flex">
                <?php
                for ($i = 0; $i < 50; $i++) {
                    $col_array = array("bg_colDarkGrey1", "bg_colGrey1", "bg_ColGreen4", "bg_ColYellow1", "bg_ColGreen3", "bg_ColPurple1", "bg_ColPink_colSet", "bg_ColRed_colSet", "bg_colGrey1", "bg_colDarkGrey1");
                    $col_array_len = count($col_array);
                    $col_rand = rand(1, $col_array_len);
                    $selected_col_no = $col_rand - 1;
                    $col_theme = $col_array[$selected_col_no];

                ?>
                    <div class="core_dot <?php echo $col_theme; ?>"></div>
                <?php
                }
                ?>
            </div>
        </div>

    </div>

</div>