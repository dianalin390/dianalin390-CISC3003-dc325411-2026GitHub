<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scenario B - Contact Form</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Contact Us</h1>

        <form action="php/contact.php" method="post" id="contactForm" novalidate>
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Subject</label>
                <input type="text" name="subject" required>
            </div>

            <div class="form-group">
                <label>Message</label>
                <textarea name="message" rows="5" required></textarea>
            </div>

            <button type="submit">Send Message</button>
        </form>
    </div>

    <footer>
        CISC3003 Web Programming: Lin Cho Kio + DC325411 + 2026
    </footer>

    <script src="js/script.js"></script>
</body>
</html>