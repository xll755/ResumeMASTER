<?php

class parse_federal extends pdf_parser
{
    public function get_personal_arry(resume_styes $headers): array {
        $pdf = $this->get_section_before($headers[0]);
        // TODO: determine how to parse a given section
        function extract_field(): string {
            $field = "";
            return $field;
        }
        $personal_arr = array(
        	"name" => extract_field(),
        	"addr" => extract_field(),
        	"contact" => extract_field(),
        );

        return $personal_arr;
    }
}
?>
