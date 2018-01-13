import React, {Component} from 'react';
import LoginForm from './forms/LoginForm';

export default class Login extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        return (
            <div className="container">
                <div className="row justify-content-md-center">
                    <div className="col-4">
                        <LoginForm/>
                    </div>
                </div>
            </div>
        );
    }
}