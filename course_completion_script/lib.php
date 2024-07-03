<?php
defined('MOODLE_INTERNAL') || die();

class local_course_completion_script_observer {
    public static function course_completed(\core\event\course_completed $event) {
        global $DB;

        // Obter o contexto e o objeto do evento
        $context = $event->get_context();
        $userid = $event->relateduserid;
        $courseid = $event->courseid;

        // Obter informações do aluno
        $user = $DB->get_record('user', array('id' => $userid), '*', MUST_EXIST);
        $username = $user->username;
        $fullname = fullname($user);

        // Obter informações do curso
        $course = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST);
        $coursename = $course->fullname;
        $courseshortname = $course->shortname;

        // Obter notas do aluno no curso
        $grades = grade_get_course_grades($courseid, $userid);

        // Implementar o código desejado aqui

        $from = 'teste@showroom.projetosuff.com.br';
        $to = 'tfreitasdesign@gmail.com';
        $subject = 'O seu listener funcionou';
        $message = 'O seu plugin funcionou corretamente!'. PHP_EOL .'Veja os dados do concluinte:'. PHP_EOL . PHP_EOL .'
                    Nome do usuário: '.$username. PHP_EOL .'
                    Nome Completo:'.$fullname. PHP_EOL .'
                    Nome do Curso Concluido:'.$coursename. PHP_EOL .'
                    Nome curto do curso:'.$courseshortname. PHP_EOL . PHP_EOL .'
                    Notas: '. PHP_EOL .'
                    '.json_encode($grades).' 
        ';
        $headers = 'From: '.$from.'';
        mail($to, $subject, $message, $headers);



        // Por exemplo, enviar um email, salvar dados em outro banco de dados, etc.
        
        // Exemplo de código para exibir informações no log com quebra de linha:s
            $logmessage = "Course completed: {$coursename}\n" .
            "Student name: {$fullname}\n" .
            "Student username: {$username}\n" .
            "Student grades: " . json_encode($grades);

            error_log($logmessage);
    }
}
