import React, { Component, useState } from "react";

// Class Component 1
class DemoForm extends Component {
    constructor(props) {
        super(props);
        this.state = {
            message: "You can Change me Value"
        };
    }

    static defaultProps = {
        message: "I am Read only"
    };

    onChange = (event) => {
        this.setState({ message: event.target.value });
    };

    render() {
        return (
            <div>
                <input
                    id="readOnly"
                    className="form-control"
                    type="text"
                    value={this.props.message}
                    readOnly
                />
                <input
                    id="readAndWrite"
                    className="form-control"
                    type="text"
                    value={this.state.message}
                    onChange={this.onChange}
                />
            </div>
        );
    }
}

// Functional Component 2
const DemoFormTwo = ({ message = "I am Read only" }) => {
    const [inputValue, setInputValue] = useState("You can Change me Value");

    return (
        <div>
            <input
                id="readOnly"
                className="form-control"
                type="text"
                value={message}
                readOnly
            />
            <input
                id="readAndWrite"
                className="form-control"
                type="text"
                value={inputValue}
                onChange={(e) => setInputValue(e.target.value)}
            />
        </div>
    );
};

// Class Component 3
class DemoFormThree extends Component {
    constructor(props) {
        super(props);
        this.state = {
            form: { firstName: "Harry", lastName: "Potter" }
        };
    }

    onChange = (event) => {
        this.setState({
            form: {
                ...this.state.form,
                [event.target.name]: event.target.value
            }
        });
    };

    onSubmit = (event) => {
        event.preventDefault();
        alert(
            `Form submitted. First Name: ${this.state.form.firstName}, Last Name: ${this.state.form.lastName}`
        );
    };

    render() {
        return (
            <form onSubmit={this.onSubmit}>
                <input
                    className="form-control"
                    name="firstName"
                    type="text"
                    value={this.state.form.firstName}
                    onChange={this.onChange}
                />
                <input
                    className="form-control"
                    name="lastName"
                    type="text"
                    value={this.state.form.lastName}
                    onChange={this.onChange}
                />
                <button type="submit">Submit</button>
            </form>
        );
    }
}

// Functional Component 4
const DemoFormFour = () => {
    const [form, setForm] = useState({ firstName: "Harry", lastName: "Potter" });

    const onChange = (event) => {
        setForm({
            ...form,
            [event.target.name]: event.target.value
        });
    };

    const onSubmit = (event) => {
        event.preventDefault();
        alert(
            `Form submitted. First Name: ${form.firstName}, Last Name: ${form.lastName}`
        );
    };

    return (
        <form onSubmit={onSubmit}>
            <input
                className="form-control"
                name="firstName"
                type="text"
                value={form.firstName}
                onChange={onChange}
            />
            <input
                className="form-control"
                name="lastName"
                type="text"
                value={form.lastName}
                onChange={onChange}
            />
            <button type="submit">Submit</button>
        </form>
    );
};

export { DemoForm, DemoFormTwo, DemoFormThree, DemoFormFour };



