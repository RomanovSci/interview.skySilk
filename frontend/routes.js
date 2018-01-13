import React from 'react';
import {
    Router,
    Route,
    RouterState,
    IndexRoute,
    hashHistory
} from 'react-router';
import Layout from './Layout';

/** Pages */
import Home from './components/pages/Home';
import NotFound from './components/pages/NotFound';
import Login from './components/pages/Login';
import Register from './components/pages/Register';
import Account from './components/pages/Account';

/** Router */
export default
<Router history={hashHistory}>
    <Route path="/" component={Layout}>
        <IndexRoute component={Home}/>
        <Route path="/login" component={Login} />
        <Route path="/register" component={Register} />
        <Route path="/account" component={Account} />

        <Route path="*" component={NotFound}/>
    </Route>
</Router>;