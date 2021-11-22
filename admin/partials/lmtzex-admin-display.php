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

$hours = [
    '00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23'
];

$minutes = [
    '00', '05', '10', '15', '20', '25', '30', '35', '40', '45', '50', '55'
];
?>
<div id="content">
    <form method="post" action="options.php">
        <?php
        $option_group = 'lmtzez_settings';
        settings_fields( $option_group );
        do_settings_sections( $option_group );
        ?>
        <h2>Lummertz Express - Configurações</h2>
        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row">Habilitar períodos de entrega:</th>
                    <td>
                        <input type="checkbox" name="_lmrtz_period_active" id="_lmrtz_period_active" class="" <?php echo get_option( '_lmrtz_period_active' ) != false ? 'checked="checked"' : ''; ?> >
                        <label for="_lmrtz_period_active">Ative para escolher o período de entrega na página de checkout.</label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Dias de entrega:</th>
                    <td>
                        <?php 
                        foreach( $weekDays as $key => $value ){
                            $valueKey   = '_lmrtz_delivery_active_' . strtolower( $value );
                            $checked    = get_option( $valueKey );
                            $isChecked  = '';
                            if( $checked ){
                                $isChecked = 'checked="checked"';
                            }
                            echo '<div class="">
                                <input type="checkbox" name="'. $valueKey .'" id="'. $valueKey .'" class="" '. $isChecked .'>
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
                            <select name="_lmtzex_delivery_start_hour" id="_lmtzex_delivery_start_hour" size="1">
                                <?php
                                $selectedHour   = get_option( '_lmtzex_delivery_start_hour' );
                                $options        = '';
                                foreach( $hours as $hour ){
                                    if( $selectedHour == $hour ){
                                        $options .= '<option selected="selected" value="'. $hour .'">'. $hour .'</option>';
                                    } else {
                                        $options .= '<option value="'. $hour .'">'. $hour .'</option>';
                                    }
                                }

                                echo $options;
                                ?>
                            </select>
                            <select name="_lmtzex_delivery_start_min" id="_lmtzex_delivery_start_min" size="1">
                                <?php 
                                $selectedMinute = get_option( '_lmtzex_delivery_start_min' );
                                unset( $options );
                                $options        = '';
                                foreach( $minutes as $minute ){
                                    if( $selectedMinute == $minute ){
                                        $options .= '<option selected="selected" value="'. $minute .'">'. $minute .'</option>';
                                    } else {
                                        $options .= '<option value="'. $minute .'">'. $minute .'</option>';
                                    }
                                }

                                echo $options;
                                ?>
                            </select>               
                        </div>
                        <div class="">
                            <label for="">Até: </label>
                            <select name="_lmtzex_delivery_end_hour" id="_lmtzex_delivery_end_hour" size="1">
                                <?php
                                $selectedHour   = get_option( '_lmtzex_delivery_end_hour' );
                                unset( $options );
                                $options        = '';
                                foreach( $hours as $hour ){
                                    if( $selectedHour == $hour ){
                                        $options .= '<option selected="selected" value="'. $hour .'">'. $hour .'</option>';
                                    } else {
                                        $options .= '<option value="'. $hour .'">'. $hour .'</option>';
                                    }
                                }

                                echo $options;
                                ?>
                            </select>
                            <select name="_lmtzex_delivery_end_min" id="_lmtzex_delivery_end_min" size="1">
                                <?php 
                                $selectedMinute = get_option( '_lmtzex_delivery_end_min' );
                                unset( $options );
                                $options        = '';
                                foreach( $minutes as $minute ){
                                    if( $selectedMinute == $minute ){
                                        $options .= '<option selected="selected" value="'. $minute .'">'. $minute .'</option>';
                                    } else {
                                        $options .= '<option value="'. $minute .'">'. $minute .'</option>';
                                    }
                                }

                                echo $options;
                                ?>
                            </select>
                        </div>
                        <em for="">Selecione o período de entregas durante o dia.</em>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Habilitar entrega no mesmo dia:</th>
                    <td>
                        <input type="checkbox" name="_lmrtz_same_day_delivery" id="_lmrtz_same_day_delivery" class="" <?php echo get_option( '_lmrtz_same_day_delivery' ) != false ? 'checked="checked"' : ''; ?>>
                        <label for="_lmrtz_same_day_delivery">Habilite a entrega no mesmo dia.</label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Horário limite para entregas no mesmo dia:</th>
                    <td>
                        <div class="">
                            <select name="_lmrtz_same_day_delivery_hour_limit" id="_lmrtz_same_day_delivery_hour_limit" size="1">
                            <?php
                                $selectedHour   = get_option( '_lmrtz_same_day_delivery_hour_limit' );
                                unset( $options );
                                $options        = '';
                                foreach( $hours as $hour ){
                                    if( $selectedHour == $hour ){
                                        $options .= '<option selected="selected" value="'. $hour .'">'. $hour .'</option>';
                                    } else {
                                        $options .= '<option value="'. $hour .'">'. $hour .'</option>';
                                    }
                                }

                                echo $options;
                                ?>
                            </select>
                            <select name="_lmrtz_same_day_delivery_min_limit" id="_lmrtz_same_day_delivery_min_limit" size="1">
                                <?php 
                                $selectedMinute = get_option( '_lmrtz_same_day_delivery_min_limit' );
                                unset( $options );
                                $options        = '';
                                foreach( $minutes as $minute ){
                                    if( $selectedMinute == $minute ){
                                        $options .= '<option selected="selected" value="'. $minute .'">'. $minute .'</option>';
                                    } else {
                                        $options .= '<option value="'. $minute .'">'. $minute .'</option>';
                                    }
                                }

                                echo $options;
                                ?>
                            </select>
                        </div>
                        <label for="_lmrtz_same_day_delivery_hour_limit">Entrega para dia atual será desativado se um pedido for feito após a hora mencionada neste campo.</label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Cores no calendário:</th>
                    <td>
                        <div class="">
                            <input type="color" name="_lmtzex_color_holidays" id="_lmtzex_color_holidays" value="<?php echo get_option( '_lmtzex_color_holidays' ) != false ? get_option( '_lmtzex_color_holidays' ) : '#dd9933'; ?>">
                            <label for="_lmtzex_color_holidays">Feriados</label>
                        </div>
                        <div class="">
                            <input type="color" name="_lmtzex_color_hour_limit" id="_lmtzex_color_hour_limit" value="<?php echo get_option( '_lmtzex_color_hour_limit' ) != false ? get_option( '_lmtzex_color_hour_limit' ) : '#dd7171'; ?>">
                            <label for="_lmtzex_color_hour_limit">Horário limite sobre datas</label>
                        </div>
                        <div class="">
                            <input type="color" name="_lmtzex_color_available" id="_lmtzex_color_available"value="<?php echo get_option( '_lmtzex_color_available' ) != false ? get_option( '_lmtzex_color_available' ) : '#a0d67a'; ?>">
                            <label for="_lmtzex_color_available">Datas disponíveis</label>
                        </div>
                        <label for="">Cores no calendário para representar dias e horários disponíveis para entregas.</label>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php submit_button( ); ?>
    </form>           
</div>