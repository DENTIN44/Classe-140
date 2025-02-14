// src/App.js
import React, { useState } from 'react';
import Calculator from './components/Calculator'; // Import Calculator component
import StatusUpdate from './components/StatusUpdate'; // Import StatusUpdate component
import './App.css';

function App() {
  const [showCalculator, setShowCalculator] = useState(true);

  const toggleCalculator = () => {
    setShowCalculator((prevState) => !prevState);
  };

  return (
    <div className="App">
      <header className="App-header">
        <h1>React Calculator App</h1>

        {/* Button to toggle Calculator visibility */}
        <button onClick={toggleCalculator} style={{ marginBottom: '20px', padding: '10px' }}>
          {showCalculator ? 'Hide' : 'Show'} Calculator
        </button>

        {/* Conditionally render Calculator */}
        {showCalculator && <Calculator />}

        {/* Status Update */}
        <StatusUpdate />
      </header>
    </div>
  );
}

export default App;
    