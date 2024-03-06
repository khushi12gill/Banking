//import logo from './logo.svg';
//import './App.css';

import './Style.css';


function App() {
  return (
    <div className="align-center">
    <h1 className="color-white">Welcome to KB</h1>
    <form className="login-form">
        <label htmlFor="username" className="color-white">Username:</label>
        <input type="text" id="username" name="username" />

        <label htmlFor="password" className="color-white">Password:</label>
        <input type="password" id="password" name="password" />

        <button type="submit" className="login-button">Login</button>
        <button type="button" className="sign-in-button">Sign In</button>
      </form>
      
    </div>
  );
}

export default App;