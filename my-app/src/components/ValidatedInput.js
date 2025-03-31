// src/components/ValidatedInput.js
import React from 'react';

const ValidatedInput = ({ label, name, formik, ...props }) => {
  const error = formik.touched[name] && formik.errors[name];

  const formClass = error ? 'form-group has-error' : 'form-group';

  return (
    <div className={formClass}>
      <label className="control-label" htmlFor={name}>
        {label}
      </label>
      <input
        className="form-control"
        name={name}
        {...props}
        onChange={formik.handleChange}
        value={formik.values[name]}
      />
      {error && <div className="help-block">{error}</div>}
    </div>
  );
};

export default ValidatedInput;
