<?php

/**
 * @file information.php
 * @description Built information tables 
 * @author Ebo Eppenga
 * @copyright 2013
 */

?>

        <div class="panel panel-info">
          <div class="panel-heading">
            <h2 class="panel-title">Device</h2>
          </div>
          <div class="panel-body">
          
            <div class="row">

              <div class="col-md-6">
                <div class="panel panel-default">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th colspan="2" class="active">Location</th>
                      </tr>
                    </thead>                 
                    <tr>
                      <td style="width: 40%;">Latitude</td>
                      <td><?php echo round($loc['lat'], 6); ?>&deg;</td>
                    </tr>
                    <tr>
                      <td>Longitude</td>
                      <td><?php echo round($loc['lon'], 6); ?>&deg;</td>
                    </tr>
                    <tr>
                      <td>Speed</td>
                      <td><?php echo round($speed * 3.6, 0); ?> km/h</td>
                    </tr>
                    <tr>
                      <td>Bearing</td>
                      <td><?php echo round($bearing, 0); ?>&deg;</td>
                    </tr>
                  </table>
                </div>
              </div>

              <div class="col-md-6">
                <div class="panel panel-default">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th colspan="2" class="active">Mobile Device</th>
                      </tr>
                    </thead>
                    <tr>
                      <td style="width: 40%;">Date</td>
                      <td><?php echo date_format(date_create($loc['log']), "Y-m-d"); ?></td>
                    </tr>
                    <tr>
                      <td>Time</td>
                      <td><?php echo date_format(date_create($loc['log']), "H:i:s"); ?></td>
                    </tr>
                    <tr>
                      <td>IP Address</td>
                      <td><?php if ($loc['ipa']) {echo $loc['ipa'];} else {echo '#N/A';} ?></td>
                    </tr>
                    <tr>
                      <td>Valid Data</td>
                      <td><?php if ($loc['val'] == 1) {echo 'Yes';} else {echo 'No';} ?></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
     