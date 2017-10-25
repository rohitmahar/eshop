<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1>Eshop - Email From Contact Form</h1>
    <p>
        Name :- {{ $contact['name'] }}
    </p>
    <p>
        Email :- {{ $contact['email'] }}
    </p>
    <p>
        Phone :- {{ $contact['phone'] ? $contact['phone'] : 'No Phone Number Provided' }}
    </p>
    <p>
        Message :- {{ $contact['message'] }}
    </p>
</body>
</html>