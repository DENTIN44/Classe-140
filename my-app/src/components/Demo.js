import React from "react";
import { useFormik } from "formik";
import * as Yup from "yup";

const Demo = () => {
  const formik = useFormik({
    initialValues: {
      userName: "",
      password: "",
    },
    validationSchema: Yup.object({
      userName: Yup.string().required("User Name is required"),
      password: Yup.string()
        .matches(/[a-zA-Z0-9]{3,30}/, "Password must be 3-30 alphanumeric characters")
        .required("Password is required"),
    }),
    validate: (values) => {
      let errors = {};
      if (values.password.includes(values.userName)) {
        errors.password = "Password cannot contain the user name.";
      }
      return Object.keys(errors).length ? errors : null;
    },
    onSubmit: (values) => {
      alert("Account created!");
    },
  });

  return (
    <div className="container mt-5">
      <div className="row justify-content-center">
        <div className="col-lg-5 col-md-6 col-sm-8">
          <div className="card shadow p-4">
            <h2 className="text-center mb-4">Sign Up</h2>
            <form onSubmit={formik.handleSubmit}>
              {/* User Name Field */}
              <div className="mb-3">
                <label htmlFor="userName" className="form-label">
                  User Name
                </label>
                <input
                  id="userName"
                  type="text"
                  name="userName"
                  className={`form-control ${formik.touched.userName && formik.errors.userName ? "is-invalid" : ""}`}
                  placeholder="Enter User Name"
                  value={formik.values.userName}
                  onChange={formik.handleChange}
                  onBlur={formik.handleBlur}
                />
                {formik.touched.userName && formik.errors.userName && (
                  <div className="invalid-feedback">{formik.errors.userName}</div>
                )}
              </div>

              {/* Password Field */}
              <div className="mb-3">
                <label htmlFor="password" className="form-label">
                  Password
                </label>
                <input
                  id="password"
                  type="password"
                  name="password"
                  className={`form-control ${formik.touched.password && formik.errors.password ? "is-invalid" : ""}`}
                  placeholder="Enter Password"
                  value={formik.values.password}
                  onChange={formik.handleChange}
                  onBlur={formik.handleBlur}
                />
                {formik.touched.password && formik.errors.password && (
                  <div className="invalid-feedback">{formik.errors.password}</div>
                )}
              </div>

              <button type="submit" className="btn btn-success w-100">
                Submit
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Demo;
