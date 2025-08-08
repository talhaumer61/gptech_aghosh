<?php
if($count>$Limit) {
    echo '
    <div class="widget-foot">
    <!--WI_PAGINATION-->
    <ul class="pagination pull-right">';
    //--------------------------------------------------
    $current_page = strstr(basename($_SERVER['REQUEST_URI']), '.php', true);	
    //--------------------------------------------------
    $pagination = "";
    if($lastpage > 1) { 
    //previous button
    if ($page > 1) {
        $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$prev.$sqlstring.'"><span class="fa fa-chevron-left"></span></a></a></li>';
    }
    //pages 
    if ($lastpage < 7 + ($adjacents * 3)) { //not enough pages to bother breaking it up
        for ($counter = 1; $counter <= $lastpage; $counter++) {
            if ($counter == $page) {
                $pagination.= '<li class="active"><a href="">'.$counter.'</a></li>';
            } else {
                $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$counter.$sqlstring.'">'.$counter.'</a></li>';
            }
        }
    } else if($lastpage > 5 + ($adjacents * 3)) { //enough pages to hide some
    //close to beginning; only hide later pages
        if($page < 1 + ($adjacents * 3)) {
            for ($counter = 1; $counter < 4 + ($adjacents * 3); $counter++) {
                if ($counter == $page) {
                    $pagination.= '<li class="active"><a href="">'.$counter.'</a></li>';
                } else {
                    $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$counter.$sqlstring.'">'.$counter.'</a></li>';
                }
            }
            $pagination.= '<li><a href="#"> ... </a></li>';
            $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$lpm1.$sqlstring.'">'.$lpm1.'</a></li>';
            $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$lastpage.$sqlstring.'">'.$lastpage.'</a></li>';   
    } else if($lastpage - ($adjacents * 3) > $page && $page > ($adjacents * 3)) { //in middle; hide some front and some back
            $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page=1'.$sqlstring.'">1</a></li>';
            $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page=2'.$sqlstring.'">2</a></li>';
            $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page=3'.$sqlstring.'">3</a></li>';
            $pagination.= '<li><a href="#"> ... </a></li>';
        for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
            if ($counter == $page) {
                $pagination.= '<li class="active"><a href="">'.$counter.'</a></li>';
            } else {
                $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$counter.$sqlstring.'">'.$counter.'</a></li>';                 
            }
        }
        $pagination.= '<li><a href="#"> ... </a></li>';
        $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$lpm1.$sqlstring.'">'.$lpm1.'</a></li>';
        $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$lastpage.$sqlstring.'">'.$lastpage.'</a></li>';   
    } else { //close to end; only hide early pages
        $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page=1'.$sqlstring.'">1</a></li>';
        $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page=2'.$sqlstring.'">2</a></li>';
        $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page=3'.$sqlstring.'">3</a></li>';
        $pagination.= '<li><a href="#"> ... </a></li>';
        for ($counter = $lastpage - (3 + ($adjacents * 3)); $counter <= $lastpage; $counter++) {
            if ($counter == $page) {
                $pagination.= '<li class="active"><a href="">'.$counter.'</a></li>';
            } else {
                $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$counter.$sqlstring.'">'.$counter.'</a></li>';                 
            }
        }
    }
    }
    //next button
    if ($page < $counter - 1) {
        $pagination.= '<li><a href="'.$current_page.'.php?'.$filters.'&page='.$next.$sqlstring.'"><span class="fa fa-chevron-right"></span></a></li>';
    } else {
        $pagination.= "";
    }
        echo $pagination;
    }
    echo '
    </ul>
    <!--WI_PAGINATION-->
        <div class="clearfix"></div>
    </div>';
}
?>