<?php

namespace inc\classes;

class CheckKatalog
{
    private $table_name;

    public function __construct()
    {
        $this->table_name = $this->get_table_name();
    }

    private function get_table_name()
    {
        global $wpdb;
        return $wpdb->prefix . 'opiop_crt';
    }

    public function find($certificateNumber)
    {
        global $wpdb;
        $result = null;


        $result = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM elpts_ru.udaxeh_opiop_crt WHERE `crt_id` = %s",
                $certificateNumber
            ),
            ARRAY_A
        );

        if (empty($result)) {
            $result = [
                'certificateNumber' => $certificateNumber,
                'status_info' => 'В реестре не найден сертификат с указанным номером.',
                'status_help' => 'Пожалуйста уточните номер сертификата. В случае, если сведения о действующем сертификате недоступны, обратитесь в АО «Электронный паспорт» через центр обработки заявок (в запросе выберите категорию запроса «Консультирование по работе Систем»)',
                'error' => true
            ];
        }

        return $result;
    }
}
