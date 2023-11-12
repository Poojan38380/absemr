<?php


require_once dirname(__FILE__, 5) . '/interface/globals.php';


function getPatientsPastAppointments($pid, $showpast, $direction = 'DESC')
{

        $query = "SELECT e.pc_eid, e.pc_aid, e.pc_title, e.pc_eventDate, e.pc_startTime, e.pc_hometext, u.fname, u.lname, u.mname, c.pc_catname, e.pc_apptstatus
                            FROM openemr_postcalendar_events AS e,
                                users AS u,
                                openemr_postcalendar_categories AS c
                            WHERE e.pc_pid = ?
                                AND e.pc_eventDate < CURRENT_DATE
                                AND u.id = e.pc_aid
                                AND e.pc_catid = c.pc_catid
                            ORDER BY e.pc_eventDate " . escape_sort_order($direction) . " , e.pc_startTime DESC LIMIT " . escape_limit($showpast);

        $pres = sqlStatement($query, [$pid]);
        $count = 0;
    $past_appts = array();
        while ($row = sqlFetchArray($pres)) {
            $count++;
            $dayname = date("D", strtotime($row['pc_eventDate']));
            $displayMeridiem = "am";
            $disphour = substr($row['pc_startTime'], 0, 2) + 0;
            $dispmin = substr($row['pc_startTime'], 3, 2);
            if ($disphour >= 12) {
                $displayMeridiem = "pm";
                if ($disphour > 12 && $GLOBALS['time_display_format'] == 1) {
                    $disphour -= 12;
                }
            }

            $petitle = xl('(Click to edit)');
            if ($row['pc_hometext'] != "") {
                $petitle = xl('Comments') . ": " . ($row['pc_hometext']) . "\r\n" . $petitle;
            }

            $row['pc_status'] = generate_display_field(array('data_type' => '1', 'list_id' => 'apptstat'), $row['pc_apptstatus']);
            $row['dayName'] = $dayname;
            $row['pc_eventTime'] = sprintf("%02d", $disphour) . ":{$dispmin}";
            $row['uname'] = text($row['fname'] . " " . $row['lname']);
            $row['jsEvent'] = attr_js(preg_replace("/-/", "", $row['pc_eventDate'])) . ', ' . attr_js($row['pc_eid']);
            $past_appts[] = $row;
        }
        return $past_appts;
}
