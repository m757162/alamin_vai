<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verification</title>
  </head>

  <body>

    <div class="">
      <p>Dear,</p>
      <p><b>{{ $user->name }}</b></p>
      <p>Easy Bangladesh need to verify your email address. Please verify your account by click <b>Verify Account</b> below -</p>
    </div>
            
    <div class="d-grid verify">
      <a href="{{ route('user.email.verification.callback', $user->id) }}" style="background: #006a5d; margin: 10px 0; padding: 7px 10px; color: white; text-decoration: none; border-radius: 3px;">Verify Account</a>
    </div>

    <div class="">
      <br>
      <p>Thanks by {{ env('APP_NAME') }}</p>
    </div>
    
  </body>
</html>

                        
                        
  