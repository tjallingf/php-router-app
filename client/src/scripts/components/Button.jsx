import '../../styles/components/Button.scss';

const Button = ({ icon, className, children, background = 'primary', ...rest }) => {
    return (
        <button {...rest} className={`Button Button--bg-${background}`}>
            <i className={`Button__icon fa-light fa-${icon || 'question-circle'}`}></i>
            {children && <div className="Button__content">{children}</div>}
        </button>
    );
}

export default Button;