<?php
    function productos_json(&$tickets, &$shirts =0, &$labels=0){
        $days = array(0 => 'un_dia', 1 => 'pase_completo', 2 => 'pase_2dias');

        unset($tickets['un_dia']['price']);
        unset($tickets['completo']['price']);   
        unset($tickets['2dias']['price']);

        $total_tickets = array_combine($days, $tickets);

        $shirts = (int) $shirts;
        if($shirts > 0):
            $total_tickets['shirts'] = $shirts;
        endif;

        $labels = (int) $labels;
        if($shirts > 0):
            $total_tickets['labels'] = $labels;
        endif;

        return json_encode($total_tickets);
    }

    function eventos_json(&$events){
        $events_json = array();
        foreach ($events as $event):
            $events_json['events'][] = $event;
        endforeach;

        return json_encode($events_json);
    }