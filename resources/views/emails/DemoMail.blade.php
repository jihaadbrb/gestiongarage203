<!DOCTYPE html>
<html lang="{{$locale}}">
<head>
    <meta charset="UTF-8">
    <title>{{ $mailData['title'] }}</title>
    <style>
        /* Email styling (optional) */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
            color: #666;
        }

        a {
            color: #333;
            text-decoration: none;
        }

        a:hover {
            color: #007bff;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    @if ($locale === 'ar')
        <h1>إشعار إكمال الإصلاح</h1>
        <p>عزيزنا العميل،</p>
        <p>نحن سعداء لإبلاغكم بأن الإصلاح المرتبط بحسابك قد تم بنجاح.</p>
        <p><strong>تفاصيل الإصلاح:</strong></p>
        <ul>
            <li>الوصف: {{ $mailData['description'] }}</li>
            <li>تاريخ الانتهاء: {{ $mailData['dateCompleted'] }}</li>
        </ul>
        <p>نأمل أن تكونوا راضين عن الخدمة المقدمة. إذا كان لديكم أي ملاحظات أو استفسارات، فلا تترددوا في التواصل معنا.</p>
        <p>كرماً منا، نقدم لكم خصمًا بنسبة 10٪ على حجز الخدمة التالية. استخدموا الرمز REPAIR10 عند الخروج.</p>
        <p>شكراً لاختياركم لخدمتنا.</p>
        <p>أطيب التحيات،</p>
        <p>غاراج جهاد</p>
    @elseif ($locale === 'es')
        <h1>Notificación de Reparación Completada</h1>
        <p>Estimado cliente,</p>
        <p>Nos complace informarle que la reparación asociada a su cuenta se ha completado con éxito.</p>
        <p><strong>Detalles de la reparación:</strong></p>
        <ul>
            <li>Descripción: {{ $mailData['description'] }}</li>
            <li>Fecha de finalización: {{ $mailData['dateCompleted'] }}</li>
        </ul>
        <p>Esperamos que esté satisfecho con el servicio proporcionado. Si tiene algún comentario o consulta, no dude en contactarnos.</p>
        <p>Como muestra de agradecimiento, le ofrecemos un descuento del 10% en su próxima reserva de servicio. Utilice el código REPAIR10 al pagar.</p>
        <p>Gracias por elegir nuestro servicio.</p>
        <p>Atentamente,</p>
        <p>Reda Elklie</p>
    @elseif ($locale === 'fr')
        <h1>Notification de Réparation Terminée</h1>
        <p>Cher client,</p>
        <p>Nous avons le plaisir de vous informer que la réparation associée à votre compte a été effectuée avec succès.</p>
        <p><strong>Détails de la réparation :</strong></p>
        <ul>
            <li>Description : {{ $mailData['description'] }}</li>
            <li>Date de fin : {{ $mailData['dateCompleted'] }}</li>
        </ul>
        <p>Nous espérons que vous êtes satisfait du service fourni. Si vous avez des commentaires ou des questions, n'hésitez pas à nous contacter.</p>
        <p>En guise de reconnaissance, nous vous offrons une remise de 10 % sur votre prochaine réservation de service. Utilisez le code REPAIR10 lors du paiement.</p>
        <p>Merci d'avoir choisi notre service.</p>
        <p>Cordialement,</p>
        <p>Reda Elklie</p>
    @else
        @if ($mailData['title'] === 'Repair Completed Notification')  
            <h1>Repair Completed Notification</h1>
            <p>Dear valued customer,</p>
            <p>We're pleased to inform you that the repair associated with your account has been successfully completed.</p>
            <p><strong>Repair Details:</strong></p>
            <ul>
                <li>Description: {{ $mailData['description'] }}</li>
                <li>Date Completed: {{ $mailData['dateCompleted'] }}</li>
            </ul>
            <p>We hope that you're satisfied with the service provided. If you have any feedback or queries, please don't hesitate to contact us.</p>
            <p>As a token of appreciation, we're offering a 10% discount on your next service booking. Use code REPAIR10 at checkout.</p>
            <p>Thank you for choosing our service.</p>
            <p>Best regards,</p>
            <p>Reda Elklie</p>
        @else
            <h1>{{ $mailData['subject'] }}</h1>
            <p>Hello ,</p>
            <p> {{ $mailData['message'] }}</p>
            <p>Best regards,</p>
            <p>Jihad garage</p>
        @endif
    @endif
</body>
</html>
