import React, { useState } from 'react';
// import Calculator from './components/Calculator'; 
import StatusUpdate from './components/StatusUpdate'; // Import StatusUpdate component
import First from './components/First'; // Import First component
import Second from './components/Second'; // Import Second component
import Third from './components/Third'; // Import Third component
import Fourth from './components/Fourth'; // Import Third component
import './App.css';

function App() {
  const [showCalculator, setShowCalculator] = useState(true);

  const toggleCalculator = () => {
    setShowCalculator((prevState) => !prevState);
  };

  return (
    <div className="App">
      <header className="App-header">
        <h1>React App</h1>

        {/* Button to toggle Calculator visibility */}
        <button onClick={toggleCalculator} style={{ marginBottom: '20px', padding: '10px' }}>
          {showCalculator ? 'Hide' : 'Show'}
        </button>

        {/* Conditionally render Calculator */}
        {/* {showCalculator && <Calculator />} */}

        {/* Status Update */}
        <StatusUpdate />

        {/* Additional components for CodePoint */}
        <First />
        <Second />

        {/* Add Third component here */}
        <Third />

        <Fourth />
      </header>
    </div>
  );
}

export default App;
