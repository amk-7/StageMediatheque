<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    .container {
      width: 80%;
      margin: auto;
      overflow: hidden;
    }

    header {
      background: #ffffff;
      color: #333;
      padding: 10px 0;
      border-bottom: 1px solid #ddd;
    }

    header a {
      color: #333;
      text-decoration: none;
      text-transform: uppercase;
      font-size: 16px;
    }

    header ul {
      padding: 0;
      margin: 0;
      list-style: none;
      overflow: hidden;
    }

    header #logo {
      text-align: left;
    }

    header #logo img {
      height: 40px;
      width: auto;
      float: left;
    }

    header #logo a {
      display: inline-block;
    }

    header nav {
      float: right;
      margin-top: 10px;
    }

    header .menu-icon {
      display: none;
    }

    header #menu {
      clear: both;
      max-height: 0;
      transition: max-height 0.2s ease-out;
    }

    header #menu.show-menu {
      max-height: 300px;
    }

    header #menu ul {
      list-style: none;
    }

    header #menu ul li {
      padding: 10px 0;
      clear: both;
    }

    header #menu ul li a {
      display: block;
      text-align: center;
      text-decoration: none;
      color: #333;
      transition: color 0.3s ease-out;
    }

    header #menu ul li a:hover {
      color: #1abc9c;
    }

    @media (max-width: 768px) {
      header #menu {
        max-height: 300px;
      }

      header .menu-icon {
        display: block;
        float: right;
        cursor: pointer;
      }

      header .menu-icon .fa {
        font-size: 24px;
      }
    }

    section {
      padding: 20px 0;
    }

    section h1 {
      color: #333;
    }

    section p {
      font-size: 18px;
      line-height: 1.6em;
      color: #666;
    }
  </style>
</head>
<body>

  <header>
    <div class="container">
      <div id="logo">
        <img src="{{ asset('storage/images/logo2.png') }}" alt="Description de l'image">
        {{-- <img src="127.0.0.1:8000/storage/images/logo.png" alt="Logo mediatheque"> --}}
        <img src="127.0.0.1:8000/storage/images/logo2.png" alt="Logo mediatheque">
      </div>
    </div>
  </header>

  <section>
    <div class="container">
      <h1> {{ $title ?? "" }} </h1>
      <p>
        Bonjour M {{ $user ?? "" }},
        {{ $content ?? "" }}
      </p>
    </div>
  </section>
</body>
</html>
