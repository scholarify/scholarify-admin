export class NotificationCard {
    // Propriétés (équivalent des props)
    private type?: string;
    private message: string;
    visible: boolean

    // Constructeur pour initialiser les props
    constructor(type: string | undefined, message: string, visible: boolean) {
        this.type = type;
        this.message = message;
        this.visible = visible;
    }

    // Méthode pour déterminer la classe de fond
    public getBgClass(): string {
        switch (this.type) {
            case 'success':
                return 'bg-[#d1fae5]'; // Vert clair pour succès
            case 'error':
            default:
                return 'bg-[#fecdd3]'; // Rouge clair pour erreur (par défaut)
        }
    }

    // Méthode pour déterminer la classe de texte
    public getTextClass(): string {
        switch (this.type) {
            case 'success':
                return 'text-[#065f46]'; // Vert foncé pour texte
            case 'error':
            default:
                return 'text-[#2d3436]'; // Gris foncé pour erreur (par défaut)
        }
    }



    // Getter pour le message (optionnel, si tu veux un accès contrôlé)
    public getMessage(): string {
        return this.message;
    }

    // Getter pour le titre basé sur le type
    public getTitle(): string {
        return this.type === 'success' ? 'Success' : 'Error';
    }
}
