const express = require('express');
const bodyParser = require('body-parser')

const transporter = require('nodemailer').createTransport({
  host: 'smtp.example.com', // SMTP server host
  port: 587, // Secure SMTP port (usually 587 or 465)
  secure: false, // Set to true if using SSL/TLS
  auth: {
    user: 'anasramadanking@gmail.com', // Your email address
    pass: 'anas.5060@@' // Your email password
  }
});
const app = express();

app.use(express.json());
app.use(express.static('dist'));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));

// Craete User Object
class User {
    username;
    email;
    password;
    isEmailVerified = false;
    createdAt;
    updatedAt;
    id;
    constructor(obj) {
        this.username = obj.username;
        this.email = obj.email;
        this.password = obj.password;
        this.isEmailVerified = false;
        this.createdAt = new Date();
        this.updatedAt = new Date();
        this.id = new Date().getTime();
    }
    findById = ()=> {
        return 'Yes'
    }
}


app.get('/',(req,res) => {
    res.sendFile(__dirname + '/dist/index.html')
})

app.post('/join', (req, res) => {
    const data = req.body;
  
    // Create a new user account
    const newUser = new User({
      username: data.username,
      email: data.email,
    });
  
    newUser.save((err, user) => {
      if (err) {
        res.status(500).json({ error: 'Error creating user' });
        return;
      }
  
    // Send a confirmation email to the user

      const mailOptions = {
        from: 'no-reply@example.com',
        to: newUser.email,
        subject: 'Welcome to our website!',
        text: `Hi ${newUser.username},
  
  Thank you for signing up for our website. Please click on the following link to confirm your email address:
        
  ${process.env.BASE_URL}/confirm-email/${newUser._id}`,
    };
    transporter.sendMail(mailOptions, (err, info) => {
      if (err) {
        console.error('Error sending confirmation email:', err);
        res.status(500).json({ error: 'Error sending confirmation email' });
        return;
      }
    })
  
      res.status(200).json({ message: 'Sign up successful. Please check your email to confirm your address.' });
  });
})
  

// Confirim Emnil
app.get('/confirm-email/:id', (req, res) => {
    const userId = req.params.id;
  
    // Find the user by their ID
    User.findById(userId, (err, user) => {
      if (err) {
        res.status(500).json({ error: 'Error finding user' });
        return;
      }
  
      if (!user) {
        res.status(404).json({ error: 'User not found' });
        return;
      }
  
      // Check if the user's email is already confirmed
      if (user.isEmailVerified) {
        res.status(200).json({ message: 'Email already confirmed' });
        return;
      }
  
      // Set the user's email as verified
      user.isEmailVerified = true;
      user.save((err) => {
        if (err) {
          res.status(500).json({ error: 'Error updating user' });
          return;
        }
  
        res.status(200).json({ message: 'Email confirmed successfully' });
      });
    });
});
  


app.listen(3000, () => {
    console.log('Listen Started At Port 3000')
})