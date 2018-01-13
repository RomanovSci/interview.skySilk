import React, {Component} from 'react';
import RegisterForm from './forms/RegisterForm';

export default class Register extends Component {

    constructor(props) {
        super(props);
    }

    render() {
        return (
            <div className="container">
                <div className="row justify-content-md-center">
                    <div className="col-4">
                        <RegisterForm/>
                    </div>
                </div>
            </div>
        );
    }
}