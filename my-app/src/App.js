// Import necessary React components
import React, { Component } from 'react';
import StatusUpdate from './components/StatusUpdate'; // Component for status update
import First from './components/First';
import Second from './components/Second';           
import Third from './components/Third';            
import Fourth from './components/Fourth';         
import HelloReact from './components/HelloReact';   
import NewApp from './NewApp.jsx';                 
import './App.css';                                // Import CSS for styling
import { DemoForm, DemoFormTwo, DemoFormThree, DemoFormFour, DemoFormFive, DemoFormSix } from './components/ControlledComponent';



/**
 * Main App component (Class-based)
 * 
 * This class-based component manages the visibility of a calculator and renders various
 * other components. It contains a button to toggle the visibility of the calculator
 * and displays several other components like `StatusUpdate`, `First`, `Second`, `Third`, 
 * `Fourth`, `NewApp`, and `HelloReact`.
 */
class App extends Component {
  // Initial state setup for managing visibility of the calculator
  constructor(props) {
    super(props);
    this.state = {
      showCalculator: true, // State to toggle the visibility of the calculator
    };
  }

  /**
   * Method to toggle the visibility of the calculator
   * This method updates the `showCalculator` state to the opposite of its current value.
   */
  toggleCalculator = () => {
    this.setState((prevState) => ({
      showCalculator: !prevState.showCalculator,
    }));
  };

  /**
 * Main App component (Class-based)
 * 
 * This class-based component manages the visibility of a calculator and renders various
 * other components. It contains a button to toggle the visibility of the calculator
 * and displays several other components like `StatusUpdate`, `First`, `Second`, `Third`, 
 * `Fourth`, `NewApp`, and `HelloReact`.
 */
// class App extends Component {
//   // Initial state setup for managing visibility of the calculator
//   constructor(props) {
//     super(props);
//     this.state = {
//       showCalculator: true, // State to toggle the visibility of the calculator
//     };
//   }

  /**
   * Method to toggle the visibility of the calculator
   * This method updates the `showCalculator` state to the opposite of its current value.
   */
  // toggleCalculator = () => {
  //   this.setState((prevState) => ({
  //     showCalculator: !prevState.showCalculator,
  //   }));
  // };

  render() {
    return (
      <div className="App">
        {/* App Header */}
        <header className="App-header">
          <h1>React App</h1>

          {/* Toggle button to show/hide the calculator */}
          <button 
            onClick={this.toggleCalculator} 
            style={{ marginBottom: '20px', padding: '10px' }}
          >
            {this.state.showCalculator ? 'Hide' : 'Show'} {/* Button text changes based on the state */}
          </button>

          {/* Display Status Update Component */}
          <StatusUpdate />

          {/* Render the other components */}
          <First />
          <br/><br/><br/><br/>
          <Second />
          <br/><br/><br/><br/>
          <Third />
          <br/><br/><br/><br/>
          <Fourth />
          <br/><br/><br/><br/>
          <NewApp />
          <br/><br/><br/><br/>
          <HelloReact />
          <br/><br/><br/><br/>
          <DemoForm />
          <br/><br/><br/><br/>
          <DemoFormTwo />
          <br/><br/><br/><br/>
          <DemoFormThree />
          <br/><br/><br/><br/>
          <DemoFormFour />
          <br/><br/><br/><br/>
          <DemoFormFive />
          <br/><br/><br/><br/>
          <DemoFormFive />
          <br/><br/><br/><br/>
          <DemoFormFive />
          <br/><br/><br/><br/>
          <DemoFormSix />
        </header>
      </div>
    );
  }
}

// Export the App class component to be used in other parts of the application
export default App;
