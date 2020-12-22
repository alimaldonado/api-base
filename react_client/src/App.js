import React from 'react';
import {BrowserRouter as Router, Switch, Route} from 'react-router-dom';
import Login from './components/auth/Login';
import Register from './components/auth/Register';
import User from './components/users/User';
import AlertState from './context/alert/altertState';

function App() {
  return (
    <AlertState>
      <Router>
      <Switch>
        <Route exact path="/" component={Login} />
        <Route exact path="/register" component={Register} />
        <Route exact path="/user" component={User} />
      </Switch>
    </Router>
    </AlertState>
  );
}

export default App;
