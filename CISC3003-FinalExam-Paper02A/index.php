<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scenario A - User Submission Form</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>CISC3003 Scenario A - Submission Form</h1>
        
        <!-- A.01: HTML Form Best Practices + A.05: POST method -->
        <form action="php/process.php" method="POST" novalidate>
            <!-- A.02: Simple Text Input -->
            <div class="form-group">
                <label for="fullname">Full Name *</label>
                <input type="text" id="fullname" name="fullname" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address *</label>
                <input type="email" id="email" name="email" required>
            </div>

            <!-- A.03: Multi-line Textarea -->
            <div class="form-group">
                <label for="message">Additional Message</label>
                <textarea id="message" name="message" rows="5"></textarea>
            </div>

            <!-- A.04: Select List -->
            <div class="form-group">
                <label for="department">Department</label>
                <select id="department" name="department">
                    <option value="">Select Department</option>
                    <option value="Computer Science">Computer Science</option>
                    <option value="Engineering">Engineering</option>
                    <option value="Business">Business</option>
                </select>
            </div>

            <!-- A.04: Radio Buttons -->
            <div class="form-group">
                <label>Gender *</label>
                <div class="radio-group">
                    <input type="radio" id="male" name="gender" value="Male" required>
                    <label for="male">Male</label>

                    <input type="radio" id="female" name="gender" value="Female">
                    <label for="female">Female</label>
                </div>
            </div>

            <!-- A.04: Checkboxes -->
            <div class="form-group">
                <label>Interests (Select all that apply)</label>
                <div class="checkbox-group">
                    <input type="checkbox" id="coding" name="interests[]" value="Coding">
                    <label for="coding">Coding</label>

                    <input type="checkbox" id="design" name="interests[]" value="Design">
                    <label for="design">Web Design</label>

                    <input type="checkbox" id="database" name="interests[]" value="Database">
                    <label for="database">Database</label>
                </div>
            </div>

            <button type="submit" name="submit_form" class="btn">Submit Data</button>
        </form>
    </div>

    <!-- REQUIRED FOOTER -->
    <footer>
        CISC3003 Web Programming: LIN CHO KIO + DC325411 + 2026
    </footer>
</body>
</html>