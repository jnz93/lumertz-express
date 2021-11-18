<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       unitycode.tech
 * @since      1.0.0
 *
 * @package    Lmtzex
 * @subpackage Lmtzex/admin/partials
 */

$weekDays = [ 
    'Domingo'       => 'sunday', 
    'Segunda Feira' => 'monday', 
    'Terça Feira'   => 'tuesday', 
    'Quarta Feira'  => 'wednesday', 
    'Quinta Feira'  => 'thursday', 
    'Sexta Feira'   => 'friday', 
    'Sábado'        => 'saturday',
];
?>
<div id="content">
    <form method="post" action="options.php">
        <!-- <input type="hidden" name="option_page" value="orddd_date_settings">
        <input type="hidden" name="action" value="update">
        <input type="hidden" id="_wpnonce" name="_wpnonce" value="040b82f23f">
        <input type="hidden" name="_wp_http_referer" value="/woocommercepro/wp-admin/admin.php?page=order_delivery_date"> -->
        <h2>Lummertz Express - Configurações</h2>
        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row">Habilitar períodos de entrega:</th>
                    <td>
                        <input type="checkbox" name="_lmrtz_period_active" id="_lmrtz_period_active" class="">
                        <label for="_lmrtz_period_active">Ative para escolher o período de entrega na página de checkout.</label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Dias de entrega:</th>
                    <td>
                        <?php 
                        foreach( $weekDays as $key => $value ){
                            $valueKey = '_lmrtz_delivery_active_' . strtolower( $value );
                            echo '<div class="">
                                <input type="checkbox" name="'. $valueKey .'" id="'. $valueKey .'" class="">
                                <label for="'. $valueKey .'">'. $key .'</label>
                            </div>';
                        }
                        ?>
                        <em>Selecione os dias de entrega.</em>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Horário de entregas:</th>
                    <td>
                        <div class="" style="margin-bottom: 4px;">
                            <label for="">Das: </label>
                            <select name="_lmtzex_delivery_from_hours" id="_lmtzex_delivery_from_hours" size="1">
                                <option selected="selected" value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                            </select>
                            <select name="_lmtzex_delivery_from_mins" id="_lmtzex_delivery_from_mins" size="1">
                                <option selected="selected" value="0">0</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="30">30</option>
                                <option value="35">35</option>
                                <option value="40">40</option>
                                <option value="45">45</option>
                                <option value="50">50</option>
                                <option value="55">55</option>
                            </select>                            
                        </div>
                        <div class="">
                            <label for="">Até: </label>
                            <select name="_lmtzex_delivery_from_hours" id="_lmtzex_delivery_from_hours" size="1">
                                <option selected="selected" value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                            </select>
                            <select name="_lmtzex_delivery_from_mins" id="_lmtzex_delivery_from_mins" size="1">
                                <option selected="selected" value="0">0</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="30">30</option>
                                <option value="35">35</option>
                                <option value="40">40</option>
                                <option value="45">45</option>
                                <option value="50">50</option>
                                <option value="55">55</option>
                            </select>
                            
                        </div>
                        <em for="">Selecione o período de entregas durante o dia.</em>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Habilitar entrega no mesmo dia:</th>
                    <td>
                        <input type="checkbox" name="_lmrtz_same_day_delivery" id="_lmrtz_same_day_delivery" class="">
                        <label for="_lmrtz_same_day_delivery">Habilite a entrega no mesmo dia para os pedidos.</label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Horário limite para entregas no mesmo dia:</th>
                    <td>
                        <div class="">
                            <select name="_lmrtz_same_day_delivery_hour_limit" id="_lmrtz_same_day_delivery_hour_limit" size="1">
                                <option selected="selected" value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                            </select>
                            <select name="_lmrtz_same_day_delivery_hour_limit" id="_lmrtz_same_day_delivery_hour_limit" size="1">
                                <option selected="selected" value="0">0</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="30">30</option>
                                <option value="35">35</option>
                                <option value="40">40</option>
                                <option value="45">45</option>
                                <option value="50">50</option>
                                <option value="55">55</option>
                            </select>
                        </div>
                        <!-- <input type="checkbox" name="_lmrtz_same_day_delivery_hour_limit" id="_lmrtz_same_day_delivery_hour_limit" class=""> -->
                        <label for="_lmrtz_same_day_delivery_hour_limit">Entrega para dia atual será desativado se um pedido for feito após a hora mencionada neste campo.</label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Cores no calendário:</th>
                    <td>
                        <div class="">
                            <input type="color" name="" id="" value="#dd9933">
                            <label for="">Feriados</label>
                        </div>
                        <div class="">
                            <input type="color" name="" id="" value="#dd7171">
                            <label for="">Horário limite sobre datas</label>
                        </div>
                        <div class="">
                            <input type="color" name="" id=""value="#a0d67a">
                            <label for="">Datas disponíveis</label>
                        </div>
                        <label for="">Cores no calendário para representar dias e horários disponíveis para entregas.</label>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit">
            <input type="submit" name="save" id="save" class="button button-primary" value="Save Settings">
        </p>
    </form>           
</div>