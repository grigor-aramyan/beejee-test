<?php
    // Count items
    $page_rows = 3;
    
    // Get rows count
    $rows = mysqli_num_rows($sql_count);
    
    // Last page
    $last = ceil($rows/$page_rows);
    
    // Check data
    if($last < 1) { $last = 1; }
    
    // Page number
    $pn = 1;
    
    // Get page number
    if(isset($_GET['pn'])) { $pn = $_GET['pn']; }
    
    // Page number settings
    if ($pn < 1) { $pn = 1; } else if ($pn > $last) { $pn = $last; }
    
    // Pagination controls
    $pagination_ctrls = '';
    
    // If more than 1 page
    if($last != 1) {
        // If not 1-st page
        if ($pn > 1) {
            // Previous page
            $previous = $pn - 1;

            // Check page
            if(isset($_GET['field']) && $_GET['field'] != NULL && isset($_GET['order']) && $_GET['order'] != NULL){ // Sort page
                $field = $_GET['field'];
                $order = $_GET['order'];
                $pagination_ctrls .= '<a href="?field='.$field.'&order='.$order.'&pn='.$previous.'" class="pn text-info">Prev</a>';
            }else{ // Other page
                $pagination_ctrls .= '<a href="?pn='.$previous.'" class="pn text-info">Prev</a>';
            }
            
            // Left from current page
            for($i = $pn - 2; $i < $pn; $i++) {
                if($i > 0){
                    if(isset($_GET['field']) && $_GET['field'] != NULL && isset($_GET['order']) && $_GET['order'] != NULL){ // Sort page
                        $field = $_GET['field'];
                        $order = $_GET['order'];
                        $pagination_ctrls .= '<a href="?field='.$field.'&order='.$order.'&pn='.$i.'" class="pn text-info">'.$i.'</a>';
                    }else{ // Other page
                        $pagination_ctrls .= '<a href="?pn='.$i.'" class="pn text-info">'.$i.'</a>';
                    }
                }
            }
        }

        // Current page
        $pagination_ctrls .= '<a class="pn text-info bg-info text-light">'.$pn.'</a>';
        
        // Right from current page
        for($i = $pn + 1; $i <= $last; $i++){
            if(isset($_GET['field']) && $_GET['field'] != NULL && isset($_GET['order']) && $_GET['order'] != NULL){ // Sort page
                $field = $_GET['field'];
                $order = $_GET['order'];
                $pagination_ctrls .= '<a href="?field='.$field.'&order='.$order.'&pn='.$i.'" class="pn text-info">'.$i.'</a>';
            }else{
                $pagination_ctrls .= '<a href="?pn='.$i.'" class="pn text-info">'.$i.'</a>';
            }
            if($i >= $pn + 2){
                break;
            }
        }

        // Next page
        if ($pn != $last) {
            $next = $pn + 1;
            if(isset($_GET['field']) && $_GET['field'] != NULL && isset($_GET['order']) && $_GET['order'] != NULL){ // Sort page
                $field = $_GET['field'];
                $order = $_GET['order'];
                $pagination_ctrls .= '<a href="?field='.$field.'&order='.$order.'&pn='.$next.'" class="pn text-info">Next</a>';
            }else{
                $pagination_ctrls .= '<a href="?pn='.$next.'" class="pn text-info">Next</a>';
            }
        }
    }

    // Start & End
    $limit = 'LIMIT ' .($pn - 1) * $page_rows .',' .$page_rows;
?>
