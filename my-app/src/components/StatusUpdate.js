import React, { useState } from 'react';

function MyComponent() {
  const [text, setText] = useState('Initial');

  const updateText = () => {
    setTimeout(() => {
      setText('Updated');
    }, 3000);
  };

  return (
    <div>
      <p>{text}</p>
      <button onClick={updateText}>Update</button>
    </div>
  );
}

export default MyComponent;
