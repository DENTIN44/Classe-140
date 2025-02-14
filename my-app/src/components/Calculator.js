import React, { useState } from 'react';
import { evaluate } from 'mathjs'; // safer alternative to eval()

function Calculator() {
  const [input, setInput] = useState('');
  const [result, setResult] = useState('');

  const handleClick = (value) => {
    if (result !== '') {
      // When there's a result, start a new calculation by appending the clicked operand
      if (['+', '-', '*', '/'].includes(value)) {
        setInput(result + value);
        setResult(''); // Clear the result after starting new calculation
      } else {
        setInput(value);
        setResult(''); // Clear the result if a number is clicked
      }
    } else {
      setInput((prevInput) => prevInput + value);
    }
  };

  const handleClear = () => {
    setInput('');
    setResult('');
  };

  const handleCalculate = () => {
    try {
      const calculationResult = evaluate(input); // Use math.js to evaluate the expression
      setResult(calculationResult);
      setInput(''); // Clear the input field after calculation
    } catch (error) {
      setResult('Error');
    }
  };

  return (
    <div style={{ padding: '20px', maxWidth: '200px', margin: '0 auto', textAlign: 'center' }}>
      <div>
        <input
          type="text"
          value={input || result}
          readOnly
          style={{
            width: '100%',
            padding: '10px',
            marginBottom: '10px',
            fontSize: '18px',
            textAlign: 'right',
          }}
        />
      </div>
      <div style={{ marginBottom: '10px' }}>
        <button onClick={() => handleClick('1')}>1</button>
        <button onClick={() => handleClick('2')}>2</button>
        <button onClick={() => handleClick('3')}>3</button>
        <button onClick={() => handleClick('+')}>+</button>
      </div>
      <div style={{ marginBottom: '10px' }}>
        <button onClick={() => handleClick('4')}>4</button>
        <button onClick={() => handleClick('5')}>5</button>
        <button onClick={() => handleClick('6')}>6</button>
        <button onClick={() => handleClick('-')}>-</button>
      </div>
      <div style={{ marginBottom: '10px' }}>
        <button onClick={() => handleClick('7')}>7</button>
        <button onClick={() => handleClick('8')}>8</button>
        <button onClick={() => handleClick('9')}>9</button>
        <button onClick={() => handleClick('*')}>*</button>
      </div>
      <div style={{ marginBottom: '10px' }}>
        <button onClick={() => handleClick('0')}>0</button>
        <button onClick={() => handleClick('.')}>.</button>
        <button onClick={handleClear}>C</button>
        <button onClick={() => handleClick('/')}>/</button>
      </div>
      <div>
        <button onClick={handleCalculate} style={{ width: '100%', padding: '10px', fontSize: '18px' }}>
          =
        </button>
      </div>
      <div>
        <p>Result: {result}</p>
      </div>
    </div>
  );
}

export default Calculator;
