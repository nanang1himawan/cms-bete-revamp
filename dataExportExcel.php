<?php
            
            foreach ($hasil as $data2) {
                $idEvent2 = $data2["id"];
                $nameEvent2 = $data2["name"];
                $hasilCustome2 = $main->getDataCustomePartisipantByIdEvent($idEvent2);

                $row = mysqli_fetch_row($hasilCustome2);

                echo "
                    
                                        <table>
                                            <thead>
                                                <tr>
                    ";

                if ($row != NULL) {
                    $header = json_decode($row[2])->player[0]->data;
                    for ($i = 0; $i < count($header); $i++) {
                        echo   "<th scope=\"col\">" . $header[$i]->state . "</th>";
                    }
                    echo "
                                                        </tr>
                                                    </thead>
                                                    <tbody>";
                                                    
                                                            foreach ($hasilCustome2 as $dataCustome2) {
                                                                    $json_data = $dataCustome2["json_data"];
                                                                    $datatabel = json_decode($json_data);
                                                                    $nonPlayer = $datatabel->nonplayer;
                                                                    $player = $datatabel->player;
                                                                    for ($i = 0; $i < count($player); $i++) {
                                                                                foreach ($player[$i] as $keyField) {
                                                                                    echo "<tr id=\"color_tabel\" class=\"table-primary\">";
                                                                                    for ($j = 0; $j < count($keyField); $j++) {
                                                                                        $dataField = $keyField[$j]->data;
                                                                                        echo "<td>" . $dataField . "</td>";
                                                                                    }
                                                                                    echo "</tr>";
                                                                                }
                                                                            }
                                                                    
                                                                }
                    
                    // foreach ($hasilCustome2 as $dataCustome2) {
                    //     $json_data = $dataCustome2["json_data"];
                    //     $datatabel = json_decode($json_data);
                    //     $nonPlayer = $datatabel->nonplayer;
                    //     $player = $datatabel->player;

                    //     echo "<tr>";
                    //     for ($i = 0; $i < count($nonPlayer); $i++) {
                    //         echo "<td>" . $nonPlayer[$i]->data . "</td>";
                    //     }
                    //     echo "</tr>";

                    //     echo "
                    //             <tr class=\"\">
                    //                 <td colspan=\"3\">
                    //                     <div class=\"table-responsive\">
                    //                         <table class=\"table\">
                    //                             <thead>
                    //                                 <tr class=\"table-primary\">";

                    //     // <th scope=\"col\">#</th>
                    //     $header2 = json_decode($row[2])->player[0]->data;
                    //     for ($i = 0; $i < count($header2); $i++) {
                    //         echo "<th scope=\"col\">" . $header2[$i]->state . "</th>";
                    //     }
                    //     echo "
                    //                                 </tr>
                    //                             </thead>
                    //                             <tbody>
                    //                                 ";
                    //     for ($i = 0; $i < count($player); $i++) {
                    //         foreach ($player[$i] as $keyField) {
                    //             echo "<tr id=\"color_tabel\" class=\"table-primary\">";
                    //             for ($j = 0; $j < count($keyField); $j++) {
                    //                 $dataField = $keyField[$j]->data;
                    //                 echo "<td>" . $dataField . "</td>";
                    //             }
                    //             echo "</tr>";
                    //         }
                    //     }
                    //     echo "
                                                       
                                                    

                    //                             </tbody>
                    //                         </table>
                    //                     </div>
                    //                 </td>


                    //             </tr>
                    //     ";
                    // }
                } else {
                    echo "<center><h6 class=\"m-0 fw-bold\">NO DATA</h6></center>";
                }

                echo "

                                                        </tbody>
                                                    </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                
                ";
            }

            ?>