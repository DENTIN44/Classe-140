// Import React and Component from the 'react' package
import React, { Component } from "react";

/**
 * HelloReact Component
 * 
 * This is a simple class-based component that demonstrates state management
 * and handling user input. It includes an input field where users can type
 * a message, and the component will update the displayed message based on
 * the user's input.
 */
class HelloReact extends Component {
  /**
   * Constructor
   * 
   * Initializes the state with a default message. The state contains one property
   * `myMessage`, which is displayed on the screen. The constructor is called when
   * the component is first created.
   */
  constructor(props) {
    super(props);
    this.state = {
      myMessage: "I am from default state", // Default message in state
    };
  }

  /**
   * Update Message Method
   * 
   * This method is invoked when the input field value changes. It updates the 
   * `myMessage` state with the value entered by the user. The `e.target.value`
   * refers to the current value of the input field.
   * 
   * @param {Object} e - The event object representing the input change event
   */
  updateMyMessage = (e) => {
    this.setState({ myMessage: e.target.value }); // Update the state with the new input value
  };

  /**
   * Render Method
   * 
   * The render method is responsible for displaying the component's UI. It returns
   * JSX elements that render an input field, a static "Hello React!!!" text, and 
   * the current value of the `myMessage` state.
   */
  render() {
    return (
      <div>
        {/* Input field where users can type a message */}
        <input type="text" onChange={this.updateMyMessage} />
        
        {/* Static text displayed below the input */}
        <div>Hello React!!!</div>
        
        {/* Display the message from the state */}
        <div>{this.state.myMessage}</div>
      </div>
    );
  }
}

// Export the HelloReact class component to be used in other parts of the application
export default HelloReact;
